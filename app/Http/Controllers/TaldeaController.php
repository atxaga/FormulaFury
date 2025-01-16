<?php

namespace App\Http\Controllers;

use App\Models\BezeroLigaGidari;
use App\Models\Gidaria;
use App\Models\Taldea;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaldeaController extends Controller
{
    public function gidariak(Request $request){

        $ligaId = session('aukeratutakoLiga');
        $bezeroa = $request->user()->bezeroa;
        $bezeroIzena = $request->user()->izena;

        if (!$ligaId) {
            return redirect()->route('eligeLiga')->with('error', 'Aukeratu liga');
        }

        $gidariak = BezeroLigaGidari::where([
            ['liga_id', '=', $ligaId],
            ['bezeroa_id', '=', $bezeroa->id ],
        ])->get();

        

        $gidariaIds = $gidariak->pluck('gidaria_id')->toArray();
        
        $taldea = BezeroLigaGidari::where([
            ['liga_id', '=', $ligaId],
            ['bezeroa_id', '=', $bezeroa->id],
        ])->first(); 
        
        if ($taldea) {
            $taldeaBezero = Taldea::where('id', $taldea->taldea_id)->first();
        }

        $gidariBezero = Gidaria::whereIn('id', $gidariaIds)->get();

        return Inertia::render('mainOrriak/gidariakMain', [
            'gidariak' => $gidariBezero,
            'taldea' => $taldeaBezero,
            'bezeroa' => $bezeroIzena
        ]);  
        

    }

    public function index(Request $request) {

        $bezero = $request->user()->izena;
        
        return Inertia::render('mainOrriak/taldeaMain', ['bezeroa' => $bezero]);
    }
}
