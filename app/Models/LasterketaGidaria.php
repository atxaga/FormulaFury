<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LasterketaGidaria extends Model
{
    protected $table = 'lasterketa_gidaria';

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
