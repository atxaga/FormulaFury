<?php

namespace App\Http\Controllers;

use App\Models\Bezeroa;
use App\Models\Gidaria;
use App\Models\Liga;
use App\Models\LigaGidari;
use App\Models\Taldea;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \Illuminate\Support\Facades\DB;

class LigaController extends Controller
{
    public function index(Request $request)
{
    $bezeroa = $request->user()->bezeroa;


    $bezeroaIzena = $request->user()->izena;
    $bezeroa = $request->user()->bezeroa;

    $ligak = $bezeroa->ligak;
    
    return Inertia::render('mainOrriak/nagusiaMain', [
        'ligak' => $ligak,
        'bezeroa' => $bezeroaIzena,
        'bezeroaDirua' => $bezeroa
    ]);
        
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

    //Gidariak insertatu

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

    //Taldeak insertatu

   $taldeak = Taldea::all();

    $pivotData = $taldeak->mapWithKeys(function ($taldeak) {
        return [
            $taldeak->id => [
                'erabilgarritasuna' => 1, 
                'erositako_prezioa' => 0,
                'saldutako_prezioa' => 0,
            ]
        ];
    })->toArray();

    $liga->taldeak()->attach($pivotData);
    
    $gidariakF1 = DB::table('gidaria_liga')
        ->join('gidariak', 'gidaria_liga.gidaria_id', '=', 'gidariak.id') 
        ->where('gidaria_liga.liga_id', $liga->id)
        ->where('gidaria_liga.erabilgarritasuna', 1)
        ->where('gidariak.kategoria', 'f1')
        ->inRandomOrder()
        ->limit(2)
        ->get();

    $gidariakF2 = DB::table('gidaria_liga')
        ->join('gidariak', 'gidaria_liga.gidaria_id', '=', 'gidariak.id') 
        ->where('gidaria_liga.liga_id', $liga->id)
        ->where('gidaria_liga.erabilgarritasuna', 1)
        ->where('gidariak.kategoria', 'f2')
        ->inRandomOrder()
        ->limit(2)
        ->get();

    $taldea = DB::table('liga_taldea')
        ->where('liga_id', $liga->id)
        ->where('erabilgarritasuna', 1)
        ->inRandomOrder()
        ->limit(1)
        ->first();

    if (!$taldea) {
        return redirect()->back()->with('error', 'Ez dago erabilgarri dagoen taldea.');
    }

    $gidariak = $gidariakF1->merge($gidariakF2);

    if ($gidariak->count() < 4) {
        return redirect()->back()->with('error', 'Ez dago nahikoa gidari erabilgarri.');
    }

    foreach ($gidariak as $gidari) {
    DB::table('bezeroa_liga_gidaria')->insert([
        'bezeroa_id' => $bezeroa->id,
        'liga_id' => $liga->id,
        'gidaria_id' => $gidari->gidaria_id,
        'taldea_id' => $taldea->taldea_id
    ]);

    DB::table('gidaria_liga')
        ->where('liga_id', $liga->id)
        ->where('gidaria_id', $gidari->gidaria_id)
        ->update(['erabilgarritasuna' => 0]);
    }
    DB::table('liga_taldea')
        ->where('liga_id', $liga->id)
        ->where('taldea_id', $taldea->taldea_id)
        ->update(['erabilgarritasuna' => 0]);
        
    return redirect()->route('ligak.index')->with('success', 'Liga sortu da! Kodedea: ' . $kodea);
}

public function sartu(Request $request) 
{
    $request->validate([
        'kodea' => 'required|string|max:6',
    ]);

    $bezeroa = $request->user()->bezeroa;

    $liga = Liga::where('kodea', '=', $request->input('kodea'))->first();

    DB::table('bezeroa_liga')->insert([
        'puntuak' => 0,
        'bezeroa_id' => $bezeroa->id,
        'liga_id' => $liga->id,
    ]);

    $gidariakF1 = DB::table('gidaria_liga')
        ->join('gidariak', 'gidaria_liga.gidaria_id', '=', 'gidariak.id') 
        ->where('gidaria_liga.liga_id', $liga->id)
        ->where('gidaria_liga.erabilgarritasuna', 1)
        ->where('gidariak.kategoria', 'f1')
        ->inRandomOrder()
        ->limit(2)
        ->get();

    $gidariakF2 = DB::table('gidaria_liga')
        ->join('gidariak', 'gidaria_liga.gidaria_id', '=', 'gidariak.id') 
        ->where('gidaria_liga.liga_id', $liga->id)
        ->where('gidaria_liga.erabilgarritasuna', 1)
        ->where('gidariak.kategoria', 'f2')
        ->inRandomOrder()
        ->limit(2)
        ->get();

    $taldea = DB::table('liga_taldea')
        ->where('liga_id', $liga->id)
        ->where('erabilgarritasuna', 1)
        ->inRandomOrder()
        ->limit(1)
        ->first();

    if (!$taldea) {
        return redirect()->back()->with('error', 'Ez dago erabilgarri dagoen taldea.');
    }

    $gidariak = $gidariakF1->merge($gidariakF2);

    if ($gidariak->count() < 4) {
        return redirect()->back()->with('error', 'Ez dago nahikoa gidari erabilgarri.');
    }

    foreach ($gidariak as $gidari) {
    DB::table('bezeroa_liga_gidaria')->insert([
        'bezeroa_id' => $bezeroa->id,
        'liga_id' => $liga->id,
        'gidaria_id' => $gidari->gidaria_id,
        'taldea_id' => $taldea->taldea_id
    ]);

    DB::table('gidaria_liga')
        ->where('liga_id', $liga->id)
        ->where('gidaria_id', $gidari->gidaria_id)
        ->update(['erabilgarritasuna' => 0]);
    }
    DB::table('liga_taldea')
        ->where('liga_id', $liga->id)
        ->where('taldea_id', $taldea->taldea_id)        
        ->update(['erabilgarritasuna' => 0]);

    return redirect()->route('ligak.index')->with('success', 'Liga-ra arrakastaz batu zara!');
}

}
    

