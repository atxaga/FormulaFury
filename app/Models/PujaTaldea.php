<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PujaTaldea extends Model
{
    protected $table = 'puja_taldea';

    protected $fillable = [
        'puja',
        'taldea_id',
        'bezeroa_id',
        'liga_id'
    ];

}
