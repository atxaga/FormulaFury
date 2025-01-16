<?php

namespace App\Http\Controllers;

use App\Models\Gidaria;
use App\Models\Liga;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KlasifikazioaController extends Controller
{
    public function index(Request $request)
{
    $ligaId = session('aukeratutakoLiga'); 

    if (!$ligaId) {
        return redirect()->route('eligeLiga')->with('error', 'Aukeratu liga');
    }

    $liga = Liga::find($ligaId);

    $bezeroak = $liga->bezeroak()->with('user')->get();

    $bezeroakData = $bezeroak->map(function ($bezero) {
        return [
            'izena' => $bezero->user->izena, 
            'dirua' => $bezero->dirua, 
            'puntuak' => $bezero->puntuak          
        ];
    });

    return Inertia::render('mainOrriak/klasifikazioaMain', [
        'liga' => $liga,
        'bezeroak' => $bezeroakData, 
        'taldeaRoute' => route('taldea'),
    ]);
}
    
}
