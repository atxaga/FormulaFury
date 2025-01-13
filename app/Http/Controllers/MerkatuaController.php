<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gidaria;
use Inertia\Inertia;

class MerkatuaController extends Controller
{
    public function index()
    {
        $pilots = Gidaria::inRandomOrder()->limit(6)->get();
        $pilotoGuztiak = Gidaria::all();

        return Inertia::render('mainOrriak/merkatuaMain', [
            'pilots' => $pilots,], ['guztiak' => $pilotoGuztiak]);    
    }
    public function gidariGuztiak(){
                
        $pilots = Gidaria::all();

        return Inertia::render('mainOrriak/bilatzaileaMain', ['pilot'=> $pilots]);
    }
    
}
