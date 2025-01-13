<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrandPrix extends Model
{
    protected $table = 'grand_prix';

    protected $fillable = [
        'izena',
        'gp',
        'izena',
        'data',
        'zirkuitua'
    ];

    public function grandPrixPuntuak() {

        return $this->hasMany(GrandPrixPuntuak::class);
    }
}
