<?php

namespace App\Http\Controllers;

use App\Models\BezeroLiga;
use App\Models\BezeroLigaGidari;
use Illuminate\Http\Request;
use App\Models\Gidaria;
use App\Models\LigaGidari;
use App\Models\Liga;
use App\Models\Ofertak;
use App\Models\Puja;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;


class MerkatuaController extends Controller
{
    public function index(Request $request)
{
    $ligaId = session('aukeratutakoLiga');
    $liga = Liga::find($ligaId);

    // Aseguramos que cada liga tenga su propio mercado
    $cacheKey = "liga_{$ligaId}_pilots";

    $pilots = Cache::remember($cacheKey, 3600, function () use ($ligaId) {
        return LigaGidari::where('erabilgarritasuna', 1)
            ->where('liga_id', $ligaId) // Asegurar que sea solo de esta liga
            ->inRandomOrder()
            ->limit(5)
            ->get()
            ->map(function ($pilot) {
                return Gidaria::find($pilot->gidaria_id);
            })
            ->filter(); // Eliminar posibles valores nulos
    });

    $pilotoGuztiak = Gidaria::all();
    $bezeroaIzena = $request->user()->izena;
    $bezeroaId = $request->user()->id;

    $bezeroaDirua = BezeroLiga::where('liga_id', $ligaId)
        ->where('bezeroa_id', $bezeroaId)
        ->first();

    $totalPuja = Puja::where('bezeroa_id', $bezeroaId)
        ->where('liga_id', $ligaId)
        ->sum('puja');

    return Inertia::render('mainOrriak/merkatuaMain', [
        'pilots' => $pilots,
        'guztiak' => $pilotoGuztiak,
        'bezeroa' => $bezeroaIzena,
        'bezeroaDirua' => $bezeroaDirua->dirua ?? 0,
        'liga' => $liga,
        'totalPuja' => $totalPuja,
    ]);
}
public function salketak(Request $request)
{
    $bezeroaCurrent = $request->user();
    $ligaId = session('aukeratutakoLiga');

    $ofertak = Ofertak::where('bezeroa_recibe', $bezeroaCurrent->id)
        ->where('liga_id', $ligaId)
        ->get();

    $liga = Liga::find($ligaId);

    $gidariaIds = $ofertak->pluck('gidaria_id')->toArray();

    $gidarias = Gidaria::whereIn('id', $gidariaIds)->get();

    $ofertas = Ofertak::whereIn('gidaria_id', $gidariaIds)
        ->select('id', 'gidaria_id', 'bezeroa_manda', 'oferta')
        ->get();

    $bezeroaMandaIds = $ofertas->pluck('bezeroa_manda')->unique()->toArray();

    $users = User::whereIn('id', $bezeroaMandaIds)->pluck('izena', 'id');

    $gidarias = $gidarias->map(function ($gidaria) use ($ofertas, $users) {
        $oferta = $ofertas->where('gidaria_id', $gidaria->id)->first();

        $gidaria->oferta_id = $oferta->id ?? null;
        $gidaria->bezeroa_manda = $oferta->bezeroa_manda ?? null;
        $gidaria->oferta = $oferta->oferta ?? null;
        $gidaria->bezeroa_manda_nombre = $users[$oferta->bezeroa_manda] ?? null;

        return $gidaria;
    });

    return Inertia::render('mainOrriak/ofertakMain', [
        'gidarias' => $gidarias,
        'liga' => $liga,
    ]);
}


    
    
}
