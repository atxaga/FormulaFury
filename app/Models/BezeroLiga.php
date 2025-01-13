<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BezeroLiga extends Model
{
    protected $table = 'bezeroa_liga';

    protected $fillable = [
        'puntuak',
        'bezeroa_id',
        'liga_id',
    ];
}
