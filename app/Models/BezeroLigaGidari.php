<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BezeroLigaGidari extends Model
{
    protected $table = 'bezeroa_liga_gidaria';

    protected $fillable = [
        'bezeroa_id',
        'liga_id',
        'gidaria_id'
    ];
}
