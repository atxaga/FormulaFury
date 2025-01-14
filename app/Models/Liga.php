<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    protected $table = 'ligak';

    protected $fillable = [
        'izena',
        'kodea',
        'deskribapena',
        'klausulak'
    ];

    public function bezeroak() {

        return $this->belongsToMany(Bezeroa::class, 'bezeroa_liga', 'liga_id', 'bezeroa_id')
                    ->using(BezeroLiga::class)
                    ->withPivot('puntuak')
                    ->withTimestamps();

    }

    public function gidariak() {

        return $this->belongsToMany(Gidaria::class)
                    ->using(LigaGidari::class)
                    ->withPivot('erabilgarritasuna', 'erositako_prezioa', 'saldutako_prezioa')
                    ->withTimestamps();                                                                                                                   
    }
}
