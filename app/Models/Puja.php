<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puja extends Model
{
    protected $table = 'pujas';

    protected $fillable = [
        'puja',
        'gidaria_id',
        'bezeroa_id',
        'liga_id'
    ];

}
