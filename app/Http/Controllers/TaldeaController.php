<?php

namespace App\Http\Controllers;

use App\Models\BezeroLigaGidari;
use App\Models\Gidaria;
use App\Models\Taldea;
use App\Models\Liga;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaldeaController extends Controller
{
    public function gidariak(Request $request){

        $ligaId = session('aukeratutakoLiga');
        $bezeroa = $request->user()->bezeroa;
        $bezeroIzena = $request->user()->izena;
        $liga = Liga::find($ligaId);

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
            'bezeroa' => $bezeroIzena,
            'liga' => $liga
        ]);  
        

    }

    

    public function index(Request $request){
        $bezero = $request->user()->bezeroa;
        $bezeroa = $request->user()->izena;

        $ligaId = session('aukeratutakoLiga');
        $liga = Liga::find($ligaId);
        $ligaIzena = $liga->izena;

        $pilots = BezeroLigaGidari::where([
            ['liga_id','=', $ligaId ],
            ['bezeroa_id','=',$bezero->id]
        ])
        ->get();

        $pilotsF1 = [];
        $pilotsF2 = [];

    foreach ($pilots as $pilot) {
        $f1 = Gidaria::where('id', $pilot->gidaria_id)
            ->where('kategoria', 'f1')
            ->get();

        $f2 = Gidaria::where('id', $pilot->gidaria_id)
            ->where('kategoria', 'f2')
            ->get();

        $pilotsF1 = array_merge($pilotsF1, $f1->toArray());
        $pilotsF2 = array_merge($pilotsF2, $f2->toArray());
        }
        $taldeaId = BezeroLigaGidari::where('liga_id', $ligaId)
            ->where('bezeroa_id', $bezero->id)
            ->first();
        $taldea = Taldea::where('id', $taldeaId->taldea_id)
        ->first();
        $taldeaIzena = $taldea->izena;



        return Inertia::render('mainOrriak/taldeaMain',[
            'bezeroa' =>$bezeroa,
            'gidariaF1'=> $pilotsF1,
            'gidariaF2' => $pilotsF2,
            'ligaIzena' => $ligaIzena,
            'taldeaIzena' => $taldeaIzena,
        ]
    );

    }
}
