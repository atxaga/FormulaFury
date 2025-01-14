<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BezeroLiga extends Pivot
{
    protected $table = 'bezeroa_liga';

    protected $fillable = [
        'puntuak',
        'bezeroa_id',
        'liga_id',
    ];
}
