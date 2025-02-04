<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntuakGidaria extends Model
{
    protected $table = 'puntuak_gidaria';

    protected $fillable = [
        'gidaria',
        'gp',
        'pos_qualy',
        'pos_race',
        'h2h_qualy',
        'h2h_race',
        'buelta_azkarra',
        'pole',
        'sprint',
        'puntuak_guztira'
    ];

    public function gidaria()
    {
        return $this->belongsTo(Gidaria::class, 'gidaria');
    }

    public function grandPrix()
    {
        return $this->belongsTo(GrandPrix::class, 'gp');
    }
}

