<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BezeroTalde extends Model
{
    protected $table = 'bezero_talde';

    protected $fillable = [
        'erositako_prezioa',
        'bezero_id',
        'taldea_id',
    ];
}
