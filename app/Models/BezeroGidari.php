<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BezeroGidari extends Model
{
    
    protected $table = 'bezero_gidari';

    protected $fillable = [
        'erositako_prezioa',
        'bezero_id',
        'gidari_id',
    ];
}


