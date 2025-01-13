<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BezeroakGrandPrix extends Model
{
    protected $table = 'bezero_gidari';

    protected $fillable = [
        'puntuak',
        'bezero_id',
        'grand_prix_puntuak_id',
    ];

    
}
