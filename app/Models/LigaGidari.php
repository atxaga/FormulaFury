<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigaGidari extends Model
{
    protected $table = 'ligak_gidariak';

    protected $fillable = [
        'liga',
        'gidaria',
        'erabilgarritasuna',
        'erositako_prezioa',
        'saldutako_prezioa',
    ];
}
