<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * Los campos que se pueden asignar de forma masiva.
     *
     * @var list<string>
     */
    protected $fillable = [
        'side',
        'type',
        'voter_token',
    ];
}
