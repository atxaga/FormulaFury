<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktibitatea extends Model
{
    protected $table = 'aktibitatea';

    protected $fillablea = [
        'bezeroa_id',
        'liga_id',
        'gidaria_id',
        'mota',
        'prezioa'
    ];

    public function gidaria()
{
    return $this->belongsTo(Gidaria::class, 'gidaria_id');
}
    public function bezeroa(){
        return $this->belongsTo(User::class, 'bezeroa_id');
    }
}
