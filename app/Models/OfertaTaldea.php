<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfertaTaldea extends Model
{
    protected $table="oferta_taldea";

    protected $fillable =[
        'oferta',
        'taldea_id',
        'bezeroa_manda',
        'bezeroa_recibe',
        'liga_id',

    ];
}
