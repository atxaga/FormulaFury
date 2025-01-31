<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gidaria extends Model
{
    protected $table = 'gidariak';

    protected $fillable = [
        'izena',
        'taldea',
        'puntuak',
        'jabea',
        'kategoria',
        'balioa',
        'disponibilitatea',
        'foto'
    ];

    public function bezeroa() {

        return $this->belongsTo(Bezeroa::class);

    }

    public function taldea() {

        return $this->belongsTo(Taldea::class);
    }

    public function puntuakGidariak() {

        return $this->hasMany(PuntuakGidaria::class);
    }

    public function puja() {

        return $this->belongsToMany(Bezeroa::class)
                    ->using(Puja::class)
                    ->withPivot('puja')
                    ->withTimestamps();
    }

    public function ligak() {

        return $this->belongsToMany(Liga::class)
                    ->using(LigaGidari::class)
                    ->withPivot('erabilgarritasuna','erositako_prezioa','saldutako_prezioa')
                    ->withTimestamps();
    }
}
