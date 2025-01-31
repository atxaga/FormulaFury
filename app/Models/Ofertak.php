<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ofertak extends Model
{
    protected $table="ofertak";

    protected $fillable =[
        'oferta',
        'gidaria_id',
        'bezeroa_manda',
        'bezeroa_recibe',
        'liga_id',

    ];
}
