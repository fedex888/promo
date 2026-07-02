<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buzo Promo 2026 · E.E.T. Nro 24</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <style>
        /* ─── Tokens ──────────────────────────────────────────────── */
        :root {
            --mint:      #4de8c4;
            --mint-lt:   #a8f5e5;
            --navy:      #1a3a5c;
            --navy-dk:   #0d2238;
            --navy-md:   #245080;
            --white:     #f5fdfb;
            --grey:      #8ab8a8;

            --like-col:  #22d48b;
            --dis-col:   #e05454;
            --voted-bg:  rgba(77,232,196,0.12);

            --radius:    16px;
            --shadow:    0 8px 32px rgba(13,34,56,.35);
        }

        /* ─── Reset ───────────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            background-color: var(--navy-dk);
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -10%, rgba(77,232,196,.18) 0%, transparent 70%),
                repeating-linear-gradient(
                    135deg,
                    transparent,
                    transparent 40px,
                    rgba(255,255,255,.012) 40px,
                    rgba(255,255,255,.012) 41px
                );
            min-height: 100vh;
            color: var(--white);
            font-family: 'Inter', sans-serif;
        }

        /* ─── Header ──────────────────────────────────────────────── */
        header {
            text-align: center;
            padding: 3.5rem 1rem 1rem;
        }

        .eyebrow {
            display: inline-block;
            font-family: 'Oswald', sans-serif;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--mint);
            border: 1px solid rgba(77,232,196,.35);
            padding: .3em 1em;
            border-radius: 100px;
            margin-bottom: 1.25rem;
        }

        h1 {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(2.6rem, 8vw, 5.5rem);
            font-weight: 700;
            line-height: .95;
            letter-spacing: -.02em;
            text-transform: uppercase;
            color: var(--white);
        }

        h1 span {
            color: var(--mint);
            display: block;
        }

        .sub {
            margin-top: 1rem;
            font-size: 1rem;
            color: var(--grey);
            max-width: 38ch;
            margin-inline: auto;
        }

        /* ─── Grid de cards ───────────────────────────────────────── */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 340px), 1fr));
            gap: 2rem;
            max-width: 880px;
            margin: 3rem auto 4rem;
            padding: 0 1.5rem;
        }

        /* ─── Card individual ─────────────────────────────────────── */
        .card {
            background: linear-gradient(160deg, rgba(255,255,255,.06) 0%, rgba(255,255,255,.02) 100%);
            border: 1px solid rgba(77,232,196,.18);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(13,34,56,.55), 0 0 0 1px rgba(77,232,196,.25);
        }

        /* foto */
        .card-img {
            position: relative;
            aspect-ratio: 3 / 4;
            overflow: hidden;
            background: var(--navy);
        }
        .card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
            transition: transform .4s ease;
        }
        .card:hover .card-img img { transform: scale(1.03); }

        /* etiqueta encima de la foto */
        .card-label {
            position: absolute;
            top: .9rem;
            left: .9rem;
            background: rgba(13,34,56,.75);
            backdrop-filter: blur(8px);
            color: var(--mint);
            font-family: 'Oswald', sans-serif;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .15em;
            text-transform: uppercase;
            padding: .3em .8em;
            border-radius: 100px;
            border: 1px solid rgba(77,232,196,.3);
        }

        /* número grande en la foto */
        .card-number {
            position: absolute;
            bottom: .75rem;
            right: .9rem;
            font-family: 'Oswald', sans-serif;
            font-size: 4rem;
            font-weight: 700;
            line-height: 1;
            color: rgba(255,255,255,.12);
            pointer-events: none;
            user-select: none;
        }

        /* cuerpo de la card */
        .card-body {
            padding: 1.4rem 1.4rem 1.6rem;
        }

        .card-title {
            font-family: 'Oswald', sans-serif;
            font-size: 1.35rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: .3rem;
        }

        .card-desc {
            font-size: .88rem;
            color: var(--grey);
            margin-bottom: 1.2rem;
            line-height: 1.55;
        }

        /* ─── Botones de voto ─────────────────────────────────────── */
        .vote-row {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .btn-vote {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .7rem 1rem;
            border-radius: 10px;
            border: none;
            font-family: 'Oswald', sans-serif;
            font-size: 1.05rem;
            font-weight: 600;
            letter-spacing: .04em;
            cursor: pointer;
            transition: background .2s, transform .15s, opacity .2s;
            position: relative;
            overflow: hidden;
        }
        .btn-vote:active { transform: scale(.96); }

        .btn-like {
            background: rgba(34,212,139,.14);
            color: var(--like-col);
            border: 1px solid rgba(34,212,139,.3);
        }
        .btn-like:hover:not(:disabled) {
            background: rgba(34,212,139,.24);
            border-color: var(--like-col);
        }

        .btn-dislike {
            background: rgba(224,84,84,.12);
            color: var(--dis-col);
            border: 1px solid rgba(224,84,84,.28);
        }
        .btn-dislike:hover:not(:disabled) {
            background: rgba(224,84,84,.22);
            border-color: var(--dis-col);
        }

        .btn-vote:disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        /* estado "ya votado" */
        .card[data-voted="true"] .card-body {
            background: var(--voted-bg);
        }
        .voted-badge {
            display: none;
            font-size: .78rem;
            color: var(--mint);
            text-align: center;
            margin-top: .7rem;
            font-weight: 500;
            letter-spacing: .04em;
        }
        .card[data-voted="true"] .voted-badge { display: block; }

        /* contadores */
        .count-like, .count-dislike {
            font-variant-numeric: tabular-nums;
            min-width: 1.8ch;
            display: inline-block;
            text-align: center;
        }

        /* ─── Footer ──────────────────────────────────────────────── */
        footer {
            text-align: center;
            padding: 2rem 1rem 3rem;
            font-size: .8rem;
            color: rgba(138,184,168,.45);
            letter-spacing: .05em;
        }
        footer strong { color: var(--mint); }

        /* ─── Ripple on vote ──────────────────────────────────────── */
        .ripple {
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            transform: scale(0);
            animation: ripple-anim .5s linear;
            pointer-events: none;
        }
        @keyframes ripple-anim {
            to { transform: scale(2.5); opacity: 0; }
        }
        .btn-like .ripple  { background: rgba(34,212,139,.35); }
        .btn-dislike .ripple { background: rgba(224,84,84,.3); }

        /* ─── Spinner dentro del botón mientras fetch ─────────────── */
        .spinner {
            display: none;
            width: 16px; height: 16px;
            border: 2px solid currentColor;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin .6s linear infinite;
            flex-shrink: 0;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .btn-vote.loading .spinner { display: block; }
        .btn-vote.loading .btn-icon { display: none; }

        /* ─── Responsive tweaks ───────────────────────────────────── */
        @media (max-width: 500px) {
            header { padding-top: 2rem; }
            .grid { gap: 1.5rem; padding: 0 1rem; }
        }

        /* ─── Reduced motion ──────────────────────────────────────── */
        @media (prefers-reduced-motion: reduce) {
            .card, .card-img img, .btn-vote { transition: none; }
            .ripple, .spinner { animation: none; }
        }
    </style>
</head>
<body>

<header>
    <div class="eyebrow">Promo 2026 · E.E.T. Nro 24 "Simón de Iriondo"</div>
    <h1>Nuestro<span>Buzo</span></h1>
    <p class="sub">Votá 👍 o 👎 para cada lado — un voto por persona.</p>
</header>

<main>
    <div class="grid">

        {{-- ───── Card FRENTE ───── --}}
        <div class="card" data-side="frente" data-voted="{{ $yaVoto['frente'] ? 'true' : 'false' }}">
            <div class="card-img">
                <img src="{{ asset('images/buzo-frente.jpg') }}"
                     alt="Frente del buzo promo 2026"
                     loading="lazy"
                     decoding="async">
                <span class="card-label">Frente</span>
                <span class="card-number">26</span>
            </div>
            <div class="card-body">
                <div class="card-title">Vista delantera</div>
                <p class="card-desc">El pecho con el nombre bordado. Simple, limpio, con identidad propia.</p>
                <div class="vote-row">
                    <button class="btn-vote btn-like" data-side="frente" data-type="like"
                            @if($yaVoto['frente']) disabled @endif
                            aria-label="Me gusta el frente del buzo">
                        <span class="btn-icon" aria-hidden="true">👍</span>
                        <span class="spinner" aria-hidden="true"></span>
                        <span class="count-like">{{ $counts['frente']['like'] }}</span>
                    </button>
                    <button class="btn-vote btn-dislike" data-side="frente" data-type="dislike"
                            @if($yaVoto['frente']) disabled @endif
                            aria-label="No me gusta el frente del buzo">
                        <span class="btn-icon" aria-hidden="true">👎</span>
                        <span class="spinner" aria-hidden="true"></span>
                        <span class="count-dislike">{{ $counts['frente']['dislike'] }}</span>
                    </button>
                </div>
                <p class="voted-badge">✓ Ya votaste este lado</p>
            </div>
        </div>

        {{-- ───── Card ESPALDA ───── --}}
        <div class="card" data-side="espalda" data-voted="{{ $yaVoto['espalda'] ? 'true' : 'false' }}">
            <div class="card-img">
                <img src="{{ asset('images/buzo-espalda.jpg') }}"
                     alt="Espalda del buzo promo 2026"
                     loading="lazy"
                     decoding="async">
                <span class="card-label">Espalda</span>
                <span class="card-number">26</span>
            </div>
            <div class="card-body">
                <div class="card-title">Vista trasera</div>
                <p class="card-desc">El número XXVI en grande con el apellido bordado abajo. El sello de la promo.</p>
                <div class="vote-row">
                    <button class="btn-vote btn-like" data-side="espalda" data-type="like"
                            @if($yaVoto['espalda']) disabled @endif
                            aria-label="Me gusta la espalda del buzo">
                        <span class="btn-icon" aria-hidden="true">👍</span>
                        <span class="spinner" aria-hidden="true"></span>
                        <span class="count-like">{{ $counts['espalda']['like'] }}</span>
                    </button>
                    <button class="btn-vote btn-dislike" data-side="espalda" data-type="dislike"
                            @if($yaVoto['espalda']) disabled @endif
                            aria-label="No me gusta la espalda del buzo">
                        <span class="btn-icon" aria-hidden="true">👎</span>
                        <span class="spinner" aria-hidden="true"></span>
                        <span class="count-dislike">{{ $counts['espalda']['dislike'] }}</span>
                    </button>
                </div>
                <p class="voted-badge">✓ Ya votaste este lado</p>
            </div>
        </div>

    </div>
</main>

<footer>
    Hecho con ♥ por la <strong>Promo 2026</strong> &nbsp;·&nbsp; E.E.T. Nro 24 "Simón de Iriondo"
</footer>

<script>
(function () {
    'use strict';

    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    /**
     * Crea el efecto ripple dentro del botón al hacer click.
     */
    function addRipple(btn, e) {
        const rect = btn.getBoundingClientRect();
        const r = document.createElement('span');
        r.className = 'ripple';
        r.style.left = (e.clientX - rect.left - 60) + 'px';
        r.style.top  = (e.clientY - rect.top  - 60) + 'px';
        btn.appendChild(r);
        r.addEventListener('animationend', () => r.remove());
    }

    /**
     * Actualiza los contadores en la card después de un voto exitoso.
     */
    function updateCard(card, side, counts) {
        const likeCount    = card.querySelector('.count-like');
        const dislikeCount = card.querySelector('.count-dislike');
        if (likeCount)    likeCount.textContent    = counts[side].like;
        if (dislikeCount) dislikeCount.textContent = counts[side].dislike;
    }

    /**
     * Marca la card como ya-votada y deshabilita ambos botones.
     */
    function markVoted(card) {
        card.dataset.voted = 'true';
        card.querySelectorAll('.btn-vote').forEach(b => b.disabled = true);
    }

    /**
     * Envía el voto al servidor vía fetch (sin recargar la página).
     */
    async function castVote(btn, e) {
        if (btn.disabled) return;

        addRipple(btn, e);

        const side = btn.dataset.side;
        const type = btn.dataset.type;
        const card = document.querySelector(`.card[data-side="${side}"]`);

        // Estado de carga
        btn.classList.add('loading');
        btn.disabled = true;

        try {
            const res = await fetch('/votar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept':       'application/json',
                    'X-CSRF-TOKEN': CSRF,
                },
                body: JSON.stringify({ side, type }),
            });

            if (!res.ok) throw new Error('Error de red: ' + res.status);

            const data = await res.json();
            updateCard(card, side, data.counts);
            markVoted(card);

        } catch (err) {
            console.error('No se pudo registrar el voto:', err);
            // Restaurar si hubo error
            btn.disabled = false;
        } finally {
            btn.classList.remove('loading');
        }
    }

    // Delegar eventos en todos los botones de voto
    document.querySelectorAll('.btn-vote').forEach(btn => {
        btn.addEventListener('click', e => castVote(btn, e));
    });
})();
</script>

</body>
</html>
