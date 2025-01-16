<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gidaria;
use App\Models\LigaGidari;
use Inertia\Inertia;

class MerkatuaController extends Controller
{
    public function index(Request $request)
{
    $pilotsId = LigaGidari::where('erabilgarritasuna', 1)
                ->inRandomOrder()
                ->limit(4)
                ->get();
    
    foreach($pilotsId as $pilots){
        $pilots = Gidaria::where('id', $pilots->gidaria_id);

    }
    $pilotoGuztiak = Gidaria::all();
    $bezeroaIzena = $request->user()->izena;

    return Inertia::render('mainOrriak/merkatuaMain', [
        'pilots' => $pilots,
        'guztiak' => $pilotoGuztiak,
        'bezeroa' => $bezeroaIzena
    ]);
}

    
    
}
