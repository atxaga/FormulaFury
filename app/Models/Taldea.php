<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taldea extends Model
{
    protected $table = 'taldeak';

    protected $fillable = [
        'izena',
        'taldea',
        'puntuak',
        'jabea',
        'kategoria',
        'balioa'
    ];

    public function bezeroa() {

        return $this->belongsTo(Bezeroa::class);
    }

    public function gidariak() {

        return $this->hasMany(Gidaria::class);
    }

    public function puntuakTaldeak() {

        return $this->hasMany(PuntuakTaldea::class);
    }
}
