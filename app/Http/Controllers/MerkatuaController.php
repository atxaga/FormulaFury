<?php

namespace App\Http\Controllers;

use App\Models\BezeroLiga;
use App\Models\BezeroLigaGidari;
use Illuminate\Http\Request;
use App\Models\Gidaria;
use App\Models\LigaGidari;
use App\Models\Liga;
use App\Models\Puja;
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
    

    
    
}
