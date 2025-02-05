<?php

namespace App\Http\Controllers;

use App\Models\Aktibitatea;
use App\Models\Liga;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AktibitateaController extends Controller
{
    public function index(Request $request){

    $bezeroa = $request->user();
    $ligaId = session('aukeratutakoLiga');
    $mugimenduak = Aktibitatea::where('liga_id', $ligaId)
    ->with('bezeroa') 
    ->with('gidaria', 'taldea')
    ->orderBy('created_at', 'desc') 
    ->get();


    $liga = Liga::findOrFail($ligaId);

    return Inertia::render('mainOrriak/aktibitateaMain', [
        'mugimenduak' => $mugimenduak,
        'liga' => $liga,
        'bezeroa' => $bezeroa->id,
       
    ]);
    }

    public function historikoa(Request $request)
{
    $ligaId = session('aukeratutakoLiga');
    $bezeroa = $request->user();

    $mugimenduak = Aktibitatea::where('liga_id', $ligaId)
        ->where('bezeroa_id', $bezeroa->id)
        ->with('gidaria','taldea') 
        ->orderBy('created_at', 'desc') 
        ->get();
    $liga = Liga::findOrFail($ligaId);

    return Inertia::render('mainOrriak/historikoaMain', [
        'mugimenduak' => $mugimenduak,
        'liga' => $liga,
        'bezeroa' => $bezeroa->izena,
        'erabiltzailea' => $bezeroa
    ]);
}

}
