<?php

namespace App\Http\Controllers;

use App\Models\Gidaria;
use App\Models\Puja;
use App\Models\Liga;
use Illuminate\Http\Request;
use Inertia\Inertia;
use IntlChar;

class PujaController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'puja' => 'required|numeric',
        'gidaria_id' => 'required|numeric',
    ]);

    $bezeroa = $request->user()->bezeroa;

    $existingPuja = Puja::where([
        ['gidaria_id', '=', $request->gidaria_id],
        ['bezeroa_id', '=', $bezeroa->id], 
    ])->first();

    if ($existingPuja) {
        $existingPuja->delete();
    }

    Puja::create([
        'puja' => $request->puja,
        'gidaria_id' => $request->gidaria_id,
        'bezeroa_id' => $bezeroa->id,
    ]);

    return redirect()->route('merkatua.index');
}

    public function destroy(Request $request)
    {
        $existingPuja = Puja::where([
            ['gidaria_id', '=', $request->id],
        ])->first();
    
        if ($existingPuja) {
            $existingPuja->delete();
        }    

    return redirect()->route('merkatua.index');
    }
    public function pujatutakoGidari(Request $request){
        
        $puja = Puja::all();
        $gidariak = Gidaria::all();
        
        $bezeroa = $request->user()->bezeroa;
        $ligaId = session('aukeratutakoLiga');
        $liga = Liga::find($ligaId);

        return Inertia::render('mainOrriak/nireopMain', [
            'puja'=> $puja,
            'gidariak'=>$gidariak,
            'bezeroa' => $bezeroa->user->izena,
            'liga' => $liga
        ]);

    }

}
