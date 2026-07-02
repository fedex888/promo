<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BuzoController extends Controller
{
    /**
     * Lados del buzo que se pueden votar.
     *
     * @var list<string>
     */
    private const SIDES = ['frente', 'espalda'];

    /**
     * Tipos de voto permitidos.
     *
     * @var list<string>
     */
    private const TYPES = ['like', 'dislike'];

    /**
     * Muestra la pagina del buzo con los conteos de votos actuales.
     */
    public function index(Request $request): View
    {
        $voterToken = $this->voterToken($request);

        return view('buzo', [
            'counts' => $this->countsFor(self::SIDES),
            'yaVoto' => [
                'frente' => $this->yaVoto('frente', $voterToken),
                'espalda' => $this->yaVoto('espalda', $voterToken),
            ],
        ]);
    }

    /**
     * Registra un voto (like/dislike) para el frente o la espalda del buzo.
     * Cada visitante (identificado por su sesion) puede votar una sola vez por lado.
     */
    public function votar(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'side' => ['required', 'string', 'in:'.implode(',', self::SIDES)],
            'type' => ['required', 'string', 'in:'.implode(',', self::TYPES)],
        ]);

        $voterToken = $this->voterToken($request);

        if (! $this->yaVoto($data['side'], $voterToken)) {
            Vote::create([
                'side' => $data['side'],
                'type' => $data['type'],
                'voter_token' => $voterToken,
            ]);
        }

        $counts = $this->countsFor(self::SIDES);

        if ($request->expectsJson()) {
            return response()->json([
                'counts' => $counts,
                'votado' => $data['side'],
            ]);
        }

        return back();
    }

    /**
     * Calcula los conteos de like/dislike para cada lado solicitado.
     *
     * @param  list<string>  $sides
     * @return array<string, array{like: int, dislike: int}>
     */
    private function countsFor(array $sides): array
    {
        $counts = [];

        foreach ($sides as $side) {
            $counts[$side] = [
                'like' => Vote::where('side', $side)->where('type', 'like')->count(),
                'dislike' => Vote::where('side', $side)->where('type', 'dislike')->count(),
            ];
        }

        return $counts;
    }

    /**
     * Indica si el visitante actual ya voto por ese lado del buzo.
     */
    private function yaVoto(string $side, string $voterToken): bool
    {
        return Vote::where('side', $side)->where('voter_token', $voterToken)->exists();
    }

    /**
     * Obtiene (o crea) un identificador anonimo por sesion para limitar un voto por lado.
     */
    private function voterToken(Request $request): string
    {
        if (! $request->session()->has('voter_token')) {
            $request->session()->put('voter_token', (string) Str::uuid());
        }

        return $request->session()->get('voter_token');
    }
}
