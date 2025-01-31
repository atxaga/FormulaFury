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
                    ->withPivot('puntuak','dirua')
                    ->withTimestamps();

    }

    public function gidariak() {

        return $this->belongsToMany(Gidaria::class)
                    ->using(LigaGidari::class)
                    ->withPivot('erabilgarritasuna', 'erositako_prezioa', 'saldutako_prezioa')
                    ->withTimestamps();                                                                                                                   
    }

    public function taldeak() {

        return $this->belongsToMany(Taldea::class)
                    ->using(LigaTaldea::class)
                    ->withPivot('erabilgarritasuna', 'erositako_prezioa', 'saldutako_prezioa')
                    ->withTimestamps();                                                                                                                   
    }

    public function plantillas()
{
    return $this->belongsToMany(Bezeroa::class, 'plantillas')
                ->using(Plantilla::class)
                ->withPivot([
                    'gidaria_f1_1',
                    'gidaria_f1_2',
                    'gidaria_f2_1',
                    'gidaria_f2_2',
                    'taldea_id'
                ])
                ->withTimestamps();
}

}
