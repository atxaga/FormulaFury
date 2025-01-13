<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntuakGidaria extends Model
{
    protected $table = 'puntuak_gidari';

    protected $fillable = [
        'gidaria',
        'puntuak_guztira',
        'gp',
        'pos_qualy',
        'pos_race',
        'h2h_qualy',
        'h2h_race',
        'buelta_azkarra',
        'pole',
        'pos_txapelketa',
    ];

    public function gidariak() {

        return $this->belongsTo(Gidaria::class);

    }

    public function grandprix() {

        return $this->belongsTo(GrandPrixPuntuak::class);
    }
}
