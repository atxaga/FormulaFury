<?php

namespace App\Http\Controllers;

use App\Models\BezeroLiga;
use App\Models\BezeroLigaGidari;
use Illuminate\Http\Request;
use App\Models\Gidaria;
use App\Models\LigaGidari;
use App\Models\Liga;
use App\Models\LigaTaldea;
use App\Models\Ofertak;
use App\Models\OfertaTaldea;
use App\Models\Puja;
use App\Models\PujaTaldea;
use App\Models\Taldea;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;


class MerkatuaController extends Controller
{
    public function index(Request $request)
{
    $ligaId = session('aukeratutakoLiga');
    $liga = Liga::find($ligaId);
    $erabiltzailea = $request->user();

    $cacheKey = "liga_{$ligaId}_pilots";
    $cacheKey2 = "liga_{$ligaId}_taldea";


    $pilotsList = Cache::remember($cacheKey, 3600, function () use ($ligaId) {
        return LigaGidari::where('erabilgarritasuna', 1)
            ->where('liga_id', $ligaId) 
            ->inRandomOrder()
            ->limit(5)
            ->get();
    });
    $taldeaList = Cache::remember($cacheKey2, 3600, function () use ($ligaId) {
        return LigaTaldea::where('erabilgarritasuna', 1)
            ->where('liga_id', $ligaId) 
            ->inRandomOrder()
            ->limit(1)
            ->first();
    });
    
    $gidariaIds = $pilotsList->pluck('gidaria_id');
    
    $pilots = Gidaria::whereIn('id', $gidariaIds)->get();
    $taldeak = Taldea::where('id', $taldeaList->taldea_id)->first();

    $pujaGuztiak = Puja::where('liga_id', $ligaId)->get();
    $pujaGuztiakTaldea = PujaTaldea::where('liga_id', $ligaId)->get();


    $pilotoGuztiak = Gidaria::all();
    $bezeroaIzena = $request->user()->izena;
    $bezeroaId = $request->user()->id;

    $bezeroaDirua = BezeroLiga::where('liga_id', $ligaId)
        ->where('bezeroa_id', $bezeroaId)
        ->first();

    $totalGidari = Puja::where('bezeroa_id', $bezeroaId)
        ->where('liga_id', $ligaId)
        ->sum('puja');
    $totalTaldea =  PujaTaldea::where('bezeroa_id', $bezeroaId)
    ->where('liga_id', $ligaId)
    ->sum('puja');

    $totalPuja = $totalGidari + $totalTaldea;


    return Inertia::render('mainOrriak/merkatuaMain', [
        'pilots' => $pilots,
        'taldeak' => $taldeak,
        'guztiak' => $pilotoGuztiak,
        'pujaGuztiak' => $pujaGuztiak,
        'pujaGuztiakTaldea' => $pujaGuztiakTaldea,
        'bezeroa' => $bezeroaIzena,
        'bezeroaDirua' => $bezeroaDirua->dirua ?? 0,
        'liga' => $liga,
        'totalPuja' => $totalPuja,
        'erabiltzailea' => $erabiltzailea
    ]);
}
public function salketak(Request $request)
{
    $bezeroaCurrent = $request->user();
    $ligaId = session('aukeratutakoLiga');

    $liga = Liga::find($ligaId);

    $ofertak = Ofertak::where('bezeroa_recibe', $bezeroaCurrent->id)
        ->where('liga_id', $ligaId)
        ->get();

    $gidariaIds = $ofertak->pluck('gidaria_id')->toArray();
    $gidarias = Gidaria::whereIn('id', $gidariaIds)->get();

    $ofertasGidariak = Ofertak::whereIn('gidaria_id', $gidariaIds)
        ->select('id', 'gidaria_id', 'bezeroa_manda', 'oferta')
        ->get();

    $ofertaTaldeak = OfertaTaldea::where('bezeroa_recibe', $bezeroaCurrent->id)
        ->where('liga_id', $ligaId)
        ->get();

    $taldeaIds = $ofertaTaldeak->pluck('taldea_id')->toArray();
    $taldeak = Taldea::whereIn('id', $taldeaIds)->get();

    $ofertakTaldeak = OfertaTaldea::whereIn('taldea_id', $taldeaIds)
        ->select('id', 'taldea_id', 'bezeroa_manda', 'oferta')
        ->get();

    $bezeroaMandaIds = collect([...$ofertasGidariak->pluck('bezeroa_manda'), ...$ofertakTaldeak->pluck('bezeroa_manda')])
        ->unique()
        ->toArray();

    $users = User::whereIn('id', $bezeroaMandaIds)->pluck('izena', 'id');

    $gidarias = $gidarias->map(function ($gidaria) use ($ofertasGidariak, $users) {
        $oferta = $ofertasGidariak->where('gidaria_id', $gidaria->id)->first();

        $gidaria->oferta_id = $oferta->id ?? null;
        $gidaria->bezeroa_manda = $oferta->bezeroa_manda ?? null;
        $gidaria->oferta = $oferta->oferta ?? null;
        $gidaria->bezeroa_manda_nombre = $users[$oferta->bezeroa_manda] ?? null;

        return $gidaria;
    });

    $taldeak = $taldeak->map(function ($taldea) use ($ofertakTaldeak, $users) {
        $oferta = $ofertakTaldeak->where('taldea_id', $taldea->id)->first();

        $taldea->oferta_id = $oferta->id ?? null;
        $taldea->bezeroa_manda = $oferta->bezeroa_manda ?? null;
        $taldea->oferta = $oferta->oferta ?? null;
        $taldea->bezeroa_manda_nombre = $users[$oferta->bezeroa_manda] ?? null;

        return $taldea;
    });

    $erabiltzailea = $request->user();
    return Inertia::render('mainOrriak/ofertakMain', [
        'gidarias' => $gidarias,
        'taldeak' => $taldeak,
        'liga' => $liga,
        'erabiltzailea' => $erabiltzailea
    ]);
}


    
    
}
