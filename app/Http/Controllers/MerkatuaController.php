<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gidaria;
use App\Models\LigaGidari;
use App\Models\Liga;
use Inertia\Inertia;

class MerkatuaController extends Controller
{
    public function index(Request $request)
{
    $ligaId = session('aukeratutakoLiga');
    $liga = Liga::find($ligaId);

    $pilotsId = LigaGidari::where('erabilgarritasuna', 1)
                ->inRandomOrder()
                ->limit(5)
                ->get();
       
    $pilots = [];

    foreach ($pilotsId as $pilot) {
        $gidaria = Gidaria::find($pilot->gidaria_id); 
        if ($gidaria) {
            $pilots[] = $gidaria; 
        }
    }
   
    $pilotoGuztiak = Gidaria::all();
    $bezeroaIzena = $request->user()->izena;

    return Inertia::render('mainOrriak/merkatuaMain', [
        'pilots' => $pilots,
        'guztiak' => $pilotoGuztiak,
        'bezeroa' => $bezeroaIzena,
        'liga' => $liga
    ]);
}

    
    
}
