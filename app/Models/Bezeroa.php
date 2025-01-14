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
                    ->withPivot('puntuak')
                    ->withTimestamps();
                    
    }

    public function puja() {

        return $this->belongsToMany(Gidaria::class)
                    ->using(Puja::class)
                    ->withPivot('puja')
                    ->withTimestamps();
    }




}
