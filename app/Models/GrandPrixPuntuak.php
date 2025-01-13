<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrandPrixPuntuak extends Model
{
    protected $table = 'grand_prix_puntuak';

    protected $fillable = [
        'izena',
        'gp',
        'bezeroa',
        'puntuak_gidaria',
        'puntuak_taldea'
    ];

    public function puntuakGidariak() {

        return $this->hasMany(Gidaria::class);

    } 

    public function puntuakTaldeak() {

        return $this->hasMany(PuntuakTaldea::class);

    }   

    public function bezeroak() {
        
        return $this->belongsToMany(Bezeroa::class)
                    ->using(BezeroakGrandPrix::class)
                    ->withPivot('puntuak')
                    ->withTimestamps();
    }

    public function grandprix() {

        return $this->belongsTo(GrandPrix::class);

    }
}
