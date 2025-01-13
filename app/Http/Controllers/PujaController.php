<?php

namespace App\Http\Controllers;

use App\Models\Puja;
use Illuminate\Http\Request;
use Inertia\Inertia;
use IntlChar;

class PujaController extends Controller
{
    public function store(Request $request)
    {
        
    $request->validate([
        'puja' => 'required|numeric',
        'izena' => 'required|string',
        'disponibilitatea' => 'required|string',
        'kategoria' => 'required|string',
        'balorea' => 'required|numeric',
        'puntuak' => 'required|numeric',
    ]);
    $existingPuja = Puja::where([
        ['izena', '=', $request->izena],
    ])->first();

    if ($existingPuja) {
        $existingPuja->delete();
    }    
    
        $puja = Puja::create($request->all());

        return redirect()->route('merkatua.index');
    }
    public function destroy(Request $request)
    {
        $existingPuja = Puja::where([
            ['izena', '=', $request->izena],
        ])->first();
    
        if ($existingPuja) {
            $existingPuja->delete();
        }    

    return redirect()->route('merkatua.index');
    }
    public function pujatutakoGidari(){
        
        $pilot = Puja::all();

        return Inertia::render('mainOrriak/nireopMain', ['pilot'=> $pilot]);

    }

}
