<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BezeroLiga extends Model
{
    protected $table = 'bezero_liga';

    protected $fillable = [
        'puntuak',
        'bezero_id',
        'liga_id',
    ];
}
