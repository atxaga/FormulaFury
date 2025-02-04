<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntuakTaldea extends Model
{
    protected $table = 'puntuak_taldea';

    protected $fillable = [
        'taldea',
        'gp',
        'pos_qualy',
        'pos_race',
        'buelta_azkarra',
        'pole',
    ];

    public function taldea()
    {
        return $this->belongsTo(Taldea::class, 'taldea');
    }

    public function grandPrix()
    {
        return $this->belongsTo(GrandPrix::class, 'gp');
    }
}
