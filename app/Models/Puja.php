<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puja extends Model
{
    protected $table = 'pujas';

    protected $fillable = [
        'puja',
        'izena',
        'puntuak',
        'kategoria',
        'balorea',
        'disponibilitatea',
    ];

    public function bezeroa(){
        return $this->belongsTo(Bezeroa::class);
    }
}
