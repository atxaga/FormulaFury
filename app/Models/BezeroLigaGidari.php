<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BezeroLigaGidari extends Model
{
    protected $table = 'bezeroa_liga_gidaria';

    protected $fillable = [
        'bezeroa_id',
        'liga_id',
        'gidaria_id',
        'gidaria_clausula',
    ];

    public function users(){

        return $this->belongsTo(User::class);

    }
    public function ligak(){

        return $this->belongsTo(Liga::class);

    }
    public function gidariak(){

        return $this->gidariak(Gidaria::class);

    }
    public function taldeak(){

        return $this->taldeak(Taldea::class);

    }
}
