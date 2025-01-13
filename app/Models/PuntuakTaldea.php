<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntuakTaldea extends Model
{
    protected $table = 'puntuak_taldea';

    protected $fillable = [
        'taldea',
        'puntuak_guztira',
        'gp',
        'pos_qualy',
        'pos_race',
        'buelta_azkarra',
        'pole',
        'pos_txapelketa',
    ];

    public function taldeak() {

        return $this->belongsTo(Taldea::class);

    }

    public function grandprix() {

        return $this->belongsTo(GrandPrixPuntuak::class);
    }
}
