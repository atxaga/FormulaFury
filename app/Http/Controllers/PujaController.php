<?php

namespace App\Http\Controllers;

use App\Models\Aktibitatea;
use App\Models\Bezeroa;
use App\Models\BezeroLiga;
use App\Models\BezeroLigaGidari;
use App\Models\BezeroLigaTalde;
use App\Models\Gidaria;
use App\Models\Puja;
use App\Models\Liga;
use App\Models\LigaGidari;
use App\Models\LigaTaldea;
use App\Models\Ofertak;
use App\Models\OfertaTaldea;
use App\Models\PujaTaldea;
use App\Models\Taldea;
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
public function storetaldea(Request $request)
{
    $ligaid = session('aukeratutakoLiga');

    $request->validate([
        'puja' => 'required|numeric',
        'taldea_id' => 'required|numeric',
    ]);

    $bezeroa = $request->user()->bezeroa;
    

    $existingPuja = PujaTaldea::where([
        ['taldea_id', '=', $request->taldea_id],
        ['bezeroa_id', '=', $bezeroa->id], 
        ['liga_id', '=', $ligaid],
    ])->first();

    $ofertada = OfertaTaldea::where([
        ['taldea_id', '=', $request->taldea_id],
        ['bezeroa_manda', '=', $request->user()->id],
        ['liga_id', '=', $ligaid],
    ])
    ->first();

    
    
    if($ofertada){
        $bezeroa_recibe = $ofertada->bezeroa_recibe;

        $ofertada->delete();

        OfertaTaldea::create([
            'liga_id'=> $ligaid,
            'bezeroa_manda'=> $bezeroa->id,
            'bezeroa_recibe' => $bezeroa_recibe,
            'taldea_id' => $request->taldea_id,
            'oferta' => $request->puja,
        ]);
    }
    
   

    if ($existingPuja) {
        $existingPuja->delete();
    }



    PujaTaldea::create([
        'puja' => $request->puja,
        'taldea_id' => $request->taldea_id,
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
    public function destroytaldea(Request $request)
    {
        $ligaId = session('aukeratutakoLiga');
        $bezeroa = $request->user();

        $existingPuja = PujaTaldea::where([
            ['taldea_id', '=', $request->id],
            ['liga_id', '=', $ligaId]
        
        ])->first();
    
        if ($existingPuja) {
            $existingPuja->delete();
        }

        $ofertada = OfertaTaldea::where([
            ['taldea_id', '=', $request->id],
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

        $taldeaId = PujaTaldea::where('liga_id', $ligaId)
        ->where('bezeroa_id', $bezeroa->id)
        ->first();

        $gidariak = [];
        foreach ($gidariakIds as $gidari) {
            $gidariak[] = Gidaria::where('id', $gidari->gidaria_id)->first(); 
        }
        if($taldeaId){
        $taldeak = Taldea::where('id', $taldeaId->taldea_id)->first();
        }

        $gidariakIdOferta = Ofertak::where('liga_id', $ligaId)
        ->where('bezeroa_manda', $bezeroa->id)
        ->get();

        $taldeakIdOferta = OfertaTaldea::where('liga_id', $ligaId)
        ->where('bezeroa_manda', $bezeroa->id)
        ->get();

        $gidariakOferta = [];
        $taldeakOferta = [];
        foreach ($gidariakIdOferta as $gidari) {
            $gidariakOferta[] = Gidaria::where('id', $gidari->gidaria_id)->first();
    }
    foreach ($taldeakIdOferta as $taldea) {
        $taldeakOferta[] = Taldea::where('id', $taldea->taldea_id)->first();
}
        


        

        return Inertia::render('mainOrriak/nireopMain', [
            'puja'=> $puja,
            'gidariak'=>$gidariak,
            'taldeak' => $taldeak ?? null,
            'gidariakOferta' => $gidariakOferta,
            'taldeakOferta' => $taldeakOferta,
            'bezeroa' => $bezeroa->user->izena,
            'liga' => $liga,
            'erabiltzailea' => $request->user()
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
    
                    $bezeroTaldea = BezeroLigaTalde::where('bezeroa_id', $maxPuja->bezeroa_id)
                        ->where('liga_id', $maxPuja->liga_id)
                        ->first();
    
                    BezeroLigaGidari::insert([
                        'gidaria_id' => $maxPuja->gidaria_id,
                        'bezeroa_id' => $maxPuja->bezeroa_id,
                        'liga_id' => $maxPuja->liga_id,
                        'gidaria_clausula' => $maxPuja->puja,
                    ]);
    
                    LigaGidari::where('gidaria_id', $maxPuja->gidaria_id)
                        ->update(['erabilgarritasuna' => 0]);

                    Aktibitatea::insert([
                            'bezeroa_id' => $maxPuja->bezeroa_id,
                            'liga_id' => $maxPuja->liga_id,
                            'gidaria_id' => $maxPuja->gidaria_id,
                            'mota' => 'erosi',
                            'prezioa' => $maxPuja->puja,
                    ]);
                }
            }
    
            $pujasTaldea = PujaTaldea::where('liga_id', $liga->id)->get(); 
    
            $maxPujasTaldea = [];
    
            foreach ($pujasTaldea as $pujaTaldea) {
                if (!isset($maxPujasTaldea[$pujaTaldea->taldea_id])) {
                    $maxPujasTaldea[$pujaTaldea->taldea_id] = $pujaTaldea;
                } else {
                    if ($pujaTaldea->puja > $maxPujasTaldea[$pujaTaldea->taldea_id]->puja) {
                        $maxPujasTaldea[$pujaTaldea->taldea_id] = $pujaTaldea;
                    }
                }
            }
    
            foreach ($maxPujasTaldea as $maxPujaTaldea) {
                $taldea = Taldea::where('id', $maxPujaTaldea->taldea_id)->first();  
    
                if ($taldea) {
                    BezeroLiga::where('bezeroa_id', $maxPujaTaldea->bezeroa_id)
                        ->where('liga_id', $maxPujaTaldea->liga_id)
                        ->decrement('dirua', $maxPujaTaldea->puja);
    
                    $bezeroTaldea = BezeroLigaTalde::where('bezeroa_id', $maxPujaTaldea->bezeroa_id)
                        ->where('liga_id', $maxPujaTaldea->liga_id)
                        ->first();
    
                    BezeroLigaTalde::insert([
                        'taldea_id' => $maxPujaTaldea->taldea_id,
                        'bezeroa_id' => $maxPujaTaldea->bezeroa_id,
                        'liga_id' => $maxPujaTaldea->liga_id,
                        'taldea_clausula' => $maxPujaTaldea->puja,
                    ]);
    
                    LigaTaldea::where('taldea_id', $maxPujaTaldea->taldea_id)
                        ->update(['erabilgarritasuna' => 0]);
                    
                    Aktibitatea::insert([
                        'bezeroa_id' => $maxPujaTaldea->bezeroa_id,
                        'liga_id' => $maxPujaTaldea->liga_id,
                        'taldea_id' => $maxPujaTaldea->taldea_id,
                        'mota' => 'erosi',
                        'prezioa' => $maxPujaTaldea->puja,

                    ]);
                }
            }
    
            
        }
    
        Puja::truncate();
        PujaTaldea::truncate();
    
        return redirect()->back();
    }
    

}
