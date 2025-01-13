<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Bezeroa extends Model
{
    

    protected $table = 'bezeroak';

    protected $fillable = [
        'puntuak',
        'premium',
        'dirua',
        'user_id' 
    ];

    public function grandprix() {
        
        return $this->belongsToMany(Bezeroa::class)
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

        return $this->belongsToMany(Liga::class)
                    ->using(BezeroLiga::class)
                    ->withPivot('puntuak')
                    ->withTimestamps();
                    
    }




}
