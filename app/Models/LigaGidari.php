<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LigaGidari extends Pivot
{
    protected $table = 'gidaria_liga';

    protected $fillable = [
        'liga',
        'gidaria',
        'erabilgarritasuna',
        'erositako_prezioa',
        'saldutako_prezioa',
    ];
}
