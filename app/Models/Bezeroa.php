<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Bezeroa extends Model
{
    

    protected $table = 'bezeroak';

    protected $fillable = [
        'puntuak',
        'premium',
        'user_id' 
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function grandprix() {
        
        return $this->belongsToMany(GrandPrix::class)
                    ->using(BezeroakGrandPrix::class)
                    ->withPivot('puntuak')
                    ->withTimestamps();

    }

    public function gidariak() {

        return $this->hasmany(Gidaria::class, 'jabea');

    }

    public function taldea() {

        return $this->hasOne(Taldea::class, 'jabea');

    }

    public function ligak() {

        return $this->belongsToMany(Liga::class, 'bezeroa_liga', 'bezeroa_id', 'liga_id')
                    ->using(BezeroLiga::class)
                    ->withPivot('puntuak','dirua')
                    ->withTimestamps();
                    
    }

    public function plantillas()
{
    return $this->belongsToMany(Liga::class, 'plantillas')
                ->using(Plantilla::class)
                ->withPivot([
                    'piloto_f1_1',
                    'piloto_f1_2',
                    'piloto_f2_1',
                    'piloto_f2_2',
                    'equipo_id'
                ])
                ->withTimestamps();
}


   




}
