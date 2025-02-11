<?php

namespace App\Http\Controllers;

use App\Models\Bezeroa;
use App\Models\BezeroLiga;
use App\Models\Gidaria;
use App\Models\Liga;
use App\Models\LigaGidari;
use App\Models\Taldea;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \Illuminate\Support\Facades\DB;
use App\Models\GrandPrix;

class LigaController extends Controller
{
    public function index(Request $request)
{
    $bezeroa = $request->user()->bezeroa;
    $erabiltzailea = $request->user();
    $bezeroaIzena = $request->user()->izena;
    
    $ligak = $bezeroa->ligak;
    
    if (!$ligak || $ligak->isEmpty()) {
        $ligak = collect([]);
    } else {
        $ligak = $ligak->map(function ($liga) use ($bezeroa) { 
            $bezeroakCount = DB::table('bezeroa_liga')
                ->where('liga_id', $liga->id)
                ->count(); 
    
            $totalDirua = DB::table('bezeroa_liga')
                ->where('liga_id', $liga->id)
                ->where('bezeroa_id', $bezeroa->id)  
                ->sum('dirua'); 
    
            return [
                'id' => $liga->id,
                'izena' => $liga->izena,
                'bezeroak_count' => $bezeroakCount,
                'total_dirua' => $totalDirua,
            ];
        });
    }
    
    
    $gidariak = Gidaria::all();
    $taldeak = Taldea::all();
    $lasterketak = GrandPrix::all();

    
    return Inertia::render('mainOrriak/nagusiaMain', [
        'ligak' => $ligak ?? null,
        'bezeroa' => $bezeroaIzena,
        'bezeroaDirua' => $bezeroa,
        'erabiltzailea' => $erabiltzailea,
        'gidariak' => $gidariak,
        'taldeak' => $taldeak,
        'lasterketak' => $lasterketak
    ]);
        
}
public function store(Request $request)
{
    $taldeak = Taldea::all();

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

    $liga->bezeroak()->attach($bezeroa->id, [
        'puntuak' => 0,
        'dirua' => 25000000
    ]);
    
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
    $taldeaBalioa = Taldea::findOrFail($taldea->taldea_id);
    $taldeaClausula = $taldeaBalioa->balioa + ($taldeaBalioa->balioa*0.1);

    if (!$taldea) {
        return redirect()->back()->with('error', 'Ez dago erabilgarri dagoen taldea.');
    }

    $gidariak = $gidariakF1->merge($gidariakF2);

    if ($gidariak->count() < 4) {
        return redirect()->back()->with('error', 'Ez dago nahikoa gidari erabilgarri.');
    }
    foreach ($gidariak as $gidari) {
    $gidariaClausula = $gidari->balioa + ($gidari->balioa*0.1);
    DB::table('bezeroa_liga_gidaria')->insert([
        'bezeroa_id' => $bezeroa->id,
        'liga_id' => $liga->id,
        'gidaria_id' => $gidari->gidaria_id,
        'gidaria_clausula' => $gidariaClausula,
    ]);
   

    DB::table('gidaria_liga')
        ->where('liga_id', $liga->id)
        ->where('gidaria_id', $gidari->gidaria_id)
        ->update(['erabilgarritasuna' => 0]);
    }

    DB::table('bezeroa_liga_taldea')->insert([
        'bezeroa_id' => $bezeroa->id,
        'liga_id' => $liga->id,
        'taldea_id' => $taldea->taldea_id,
        'taldea_clausula' => $taldeaClausula,
    ]);

    DB::table('liga_taldea')
        ->where('liga_id', $liga->id)
        ->where('taldea_id', $taldea->taldea_id)
        ->update(['erabilgarritasuna' => 0]);
        
    return Inertia::location(route('setLiga', ['id' => $liga->id]));

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
        'dirua' => 25000000,
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
    $taldeaBalioa = Taldea::findOrFail($taldea->taldea_id);
    $taldeaClausula = $taldeaBalioa->balioa + ($taldeaBalioa->balioa*0.1);



    foreach ($gidariak as $gidari) {
    $gidariaClausula = $gidari->balioa + ($gidari->balioa*0.1);
    DB::table('bezeroa_liga_gidaria')->insert([
        'bezeroa_id' => $bezeroa->id,
        'liga_id' => $liga->id,
        'gidaria_id' => $gidari->gidaria_id,
        'gidaria_clausula' => $gidariaClausula,
    ]);
    

    DB::table('gidaria_liga')
        ->where('liga_id', $liga->id)
        ->where('gidaria_id', $gidari->gidaria_id)
        ->update(['erabilgarritasuna' => 0]);
    }
    DB::table('bezeroa_liga_taldea')->insert([
        'bezeroa_id' => $bezeroa->id,
        'liga_id' => $liga->id,
        'taldea_id' => $taldea->taldea_id,
        'taldea_clausula' => $taldeaClausula,
    ]);
    
    DB::table('liga_taldea')
        ->where('liga_id', $liga->id)
        ->where('taldea_id', $taldea->taldea_id)        
        ->update(['erabilgarritasuna' => 0]);

    return Inertia::location(route('setLiga', ['id' => $liga->id]));
}
public function abandonarLiga(Request $request){
    $ligaId = $request->id;
    $bezeroa = $request->user()->id;


    BezeroLiga::where('liga_id', $ligaId)
    ->where('bezeroa_id', $bezeroa)
    ->delete();


    return redirect()->back();
}

}
    

