<?php

namespace App\Http\Controllers;

use App\Models\Bezeroa;
use App\Models\Gidaria;
use App\Models\Liga;
use App\Models\LigaGidari;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LigaController extends Controller
{
    public function index(Request $request)
{
    $bezeroa = $request->user()->bezeroa;

    $ligak = $bezeroa->ligak;
    
    return Inertia::render('mainOrriak/nagusiaMain', [
        'ligak' => $ligak,]);
}
public function store(Request $request)
{
    
    $request->validate([
        'izena' => 'required|min:5|max:30', 
        'deskribapena' => 'nullable|max:255', 
    ]);

    
    do {
        $kodea = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6)); 
    } while (Liga::where('kodea', $kodea)->exists());

   
    $liga = Liga::create([
        'izena' => $request->input('izena'),
        'partaideak' => 0,
        'deskribapena' => $request->input('deskribapena'),
        'kodea' => $kodea,
        'klausulak' => $request->input('klasulazo'),
    ]);

    
    $bezeroa = $request->user()->bezeroa;

    $liga->bezeroak()->attach($bezeroa->id, ['puntuak' => 0]);

    $gidariak = Gidaria::all();

    $pivotData = $gidariak->mapWithKeys(function ($gidariak) {
        return [
            $gidariak->id => [
                'erabilgarritasuna' => 1, 
                'erositako_prezioa' => 0,
                'saldutako_prezioa' => 0,
            ]
        ];
    })->toArray();

    $liga->gidariak()->attach($pivotData);

    return redirect()->route('ligak.index')->with('success', 'Liga sortu da! Kodedea: ' . $kodea);
}

public function sartu(Request $request) {

    $request->validate([
        'kodea' => 'required|string|max:6',
    ]);

    $bezeroa = $request->user()->bezeroa;

    $liga = Liga::where('kodea', '=', $request->input('kodea'))->first();

    \Illuminate\Support\Facades\DB::table('bezeroa_liga')->insert([
        'puntuak' => 0,
        'bezeroa_id' => $bezeroa->id,
        'liga_id' => $liga->id,
    ]);

}


    
}
