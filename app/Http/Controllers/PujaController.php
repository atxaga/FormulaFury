<?php

namespace App\Http\Controllers;

use App\Models\Aktibitatea;
use App\Models\Bezeroa;
use App\Models\BezeroLiga;
use App\Models\BezeroLigaGidari;
use App\Models\Gidaria;
use App\Models\Puja;
use App\Models\Liga;
use App\Models\LigaGidari;
use App\Models\Ofertak;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use IntlChar;

class PujaController extends Controller
{
    public function store(Request $request)
{
    $ligaid = session('aukeratutakoLiga');

    $request->validate([
        'puja' => 'required|numeric',
        'gidaria_id' => 'required|numeric',
    ]);

    $bezeroa = $request->user()->bezeroa;
    

    $existingPuja = Puja::where([
        ['gidaria_id', '=', $request->gidaria_id],
        ['bezeroa_id', '=', $bezeroa->id], 
        ['liga_id', '=', $ligaid],
    ])->first();

    $ofertada = Ofertak::where([
        ['gidaria_id', '=', $request->gidaria_id],
        ['bezeroa_manda', '=', $request->user()->id],
        ['liga_id', '=', $ligaid],
    ])
    ->first();

    
    
    if($ofertada){
        $bezeroa_recibe = $ofertada->bezeroa_recibe;

        $ofertada->delete();

        Ofertak::create([
            'liga_id'=> $ligaid,
            'bezeroa_manda'=> $bezeroa->id,
            'bezeroa_recibe' => $bezeroa_recibe,
            'gidaria_id' => $request->gidaria_id,
            'oferta' => $request->puja,
        ]);
    }
    
   

    if ($existingPuja) {
        $existingPuja->delete();
    }



    Puja::create([
        'puja' => $request->puja,
        'gidaria_id' => $request->gidaria_id,
        'bezeroa_id' => $bezeroa->id,
        'liga_id' => $ligaid,
    ]);

    

    return redirect()->route('merkatua.index');
}

    public function destroy(Request $request)
    {
        $ligaId = session('aukeratutakoLiga');
        $bezeroa = $request->user();

        $existingPuja = Puja::where([
            ['gidaria_id', '=', $request->id],
            ['liga_id', '=', $ligaId]
        
        ])->first();
    
        if ($existingPuja) {
            $existingPuja->delete();
        }

        $ofertada = Ofertak::where([
            ['gidaria_id', '=', $request->id],
            ['bezeroa_manda', '=', $bezeroa->id],
            ['liga_id', '=', $ligaId],
        ])
        ->first();

        if($ofertada){
            $ofertada->delete();
        }

    return redirect()->route('merkatua.index');
    }
    public function pujatutakoGidari(Request $request){
        
        $puja = Puja::all();
        
        $bezeroa = $request->user()->bezeroa;
        $ligaId = session('aukeratutakoLiga');
        $liga = Liga::find($ligaId);


        $gidariakIds = Puja::where('liga_id', $ligaId)
        ->where('bezeroa_id', $bezeroa->id)
        ->get();

        $gidariak = [];
        foreach ($gidariakIds as $gidari) {
            $gidariak[] = Gidaria::where('id', $gidari->gidaria_id)->first(); 
        }
        


        

        return Inertia::render('mainOrriak/nireopMain', [
            'puja'=> $puja,
            'gidariak'=>$gidariak,
            'bezeroa' => $bezeroa->user->izena,
            'liga' => $liga
        ]);

    }
    
    public function bukaera()
{
    $ligas = Liga::all();  

    foreach ($ligas as $liga) {
        $pujas = Puja::where('liga_id', $liga->id)->get(); 

        $maxPujas = [];

        foreach ($pujas as $puja) {
            if (!isset($maxPujas[$puja->gidaria_id])) {
                $maxPujas[$puja->gidaria_id] = $puja;
            } else {
                if ($puja->puja > $maxPujas[$puja->gidaria_id]->puja) {
                    $maxPujas[$puja->gidaria_id] = $puja;
                }
            }
        }

        foreach ($maxPujas as $maxPuja) {
            $gidaria = Gidaria::where('id', $maxPuja->gidaria_id)->first();  

            if ($gidaria) {
                BezeroLiga::where('bezeroa_id', $maxPuja->bezeroa_id)
                    ->where('liga_id', $maxPuja->liga_id)
                    ->decrement('dirua', $maxPuja->puja);

                $bezeroTaldea = BezeroLigaGidari::where('bezeroa_id', $maxPuja->bezeroa_id)
                    ->where('liga_id', $maxPuja->liga_id)
                    ->first();

                BezeroLigaGidari::insert([
                    'gidaria_id' => $maxPuja->gidaria_id,
                    'bezeroa_id' => $maxPuja->bezeroa_id,
                    'liga_id' => $maxPuja->liga_id,
                    'taldea_id' => $bezeroTaldea->taldea_id,
                    'gidaria_clausula' => $maxPuja->puja,
                    'taldea_clausula' => 0
                ]);

                LigaGidari::where('gidaria_id', $maxPuja->gidaria_id)
                    ->update(['erabilgarritasuna' => 0]);
            }
        }
        
    }
    Aktibitatea::insert([
        'bezeroa_id' => $maxPuja->bezeroa_id,
        'liga_id' => $maxPuja->liga_id,
        'gidaria_id' => $maxPuja->gidaria_id,
        'mota' => "erosi",
        'prezioa' => $maxPuja->puja,
        'created_at' => now(),
        'updated_at' => now() 
    ]);

    Puja::truncate();

    return redirect()->back();
}

}
