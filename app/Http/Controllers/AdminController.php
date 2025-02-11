<?php

namespace App\Http\Controllers;

use App\Models\Bezeroa;
use Illuminate\Http\Request;
use App\Models\Gidaria;
use App\Models\User;
use App\Models\GrandPrix;
use App\Models\LasterketaGidaria;
use App\Models\LasterketaTaldea;
use App\Models\Liga;
use App\Models\Taldea;
use App\Models\PuntuakGidaria;
use App\Models\PuntuakTaldea;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index() {

        $gidariak = Gidaria::all();
        $taldeak = Taldea::all();
        $lasterketak = GrandPrix::all();

        return Inertia::render('mainOrriak/puntuakgehituMain', [
            'gidariak' => $gidariak,
            'taldeak' => $taldeak,
            'lasterketak' => $lasterketak
        ]);
    }

    public function gorde(Request $request)
    {
        if ($request->tipo == 'gidariak') {
            $this->puntuakGidaria($request, $request->kategoria);
        } else {
            $this->procesarPuntuakTaldea($request);
        }
    }

    public function puntuakGidaria($request, $kategoria) {

        $posizioa_h2h_qualy = $request->data['h2h_qualy'] ?? false ? "bai" : "ez";
        $posizioa_h2h_race = $request->data['h2h_race'] ?? false ? "bai" : "ez";
        $posizioa_buelta_azkarra = $request->data['buelta_azkarra'] ?? false ? "bai" : "ez";
        $posizioa_pole = $request->data['pole'] ?? false ? "bai" : "ez";
        $posizioa_sprint = $request->data['sprint'] ?? 0;

        LasterketaGidaria::create([
            'gidaria' => $request->aukeratutakoa,
            'gp' => $request->gp,
            'pos_qualy' => $request->data['pos_qualy'],
            'pos_race' => $request->data['pos_race'],
            'h2h_qualy' => $posizioa_h2h_qualy,
            'h2h_race' => $posizioa_h2h_race,
            'buelta_azkarra' => $posizioa_buelta_azkarra,
            'pole' => $posizioa_pole,
            'sprint' => $posizioa_sprint
        ]);
    
        $data = [
            'gidaria' => $request->aukeratutakoa,
            'gp' => $request->gp,
            'pos_qualy' => $request->data['pos_qualy'],
            'pos_race' => $request->data['pos_race'],
            'h2h_qualy' => $request->data['h2h_qualy'],
            'h2h_race' => $request->data['h2h_race'],
            'buelta_azkarra' => $request->data['buelta_azkarra'],
            'pole' => $request->data['pole'],
            'sprint' => $request->data['sprint']
        ];

        if ($kategoria == 'F1') {

            $puntuak_qualy = $this->calcularPuntuacionQualy($data['pos_qualy'] ?? 0);
            $puntuak_race = $this->puntuazioaLasterketaGidari($data['pos_race'] ?? 0);
            $puntuak_h2h_qualy = $data['h2h_qualy'] ?? false ? 3 : 0;
            $puntuak_h2h_race = $data['h2h_race'] ?? false ? 6 : 0;
            $puntuak_buelta_azkarra = $data['buelta_azkarra'] ?? false ? 2 : 0;
            $puntuak_pole = $data['pole'] ?? false ? 3 : 0;
            $puntuak_sprint = $this->puntuazioaSprint($data['sprint']) ?? 0;

            $puntuak_guztira = $puntuak_qualy + $puntuak_race + $puntuak_h2h_qualy + $puntuak_h2h_race + $puntuak_buelta_azkarra + $puntuak_pole + $puntuak_sprint;

        } else {
            $puntuak_qualy = $this->puntuakQualyF2($data['pos_qualy'] ?? 0);
            $puntuak_race = $this->puntuazioaLasterketaGidariF2($data['pos_race'] ?? 0);
            $puntuak_h2h_qualy = $data['h2h_qualy'] ?? false ? 3 : 0;
            $puntuak_h2h_race = $data['h2h_race'] ?? false ? 3 : 0;
            $puntuak_buelta_azkarra = $data['buelta_azkarra'] ?? false ? 1 : 0;
            $puntuak_pole = $data['pole'] ?? false ? 2 : 0;
            $puntuak_sprint = $this->puntuazioaSprint($data['sprint']) ?? 0;

            $puntuak_guztira = $puntuak_qualy + $puntuak_race + $puntuak_h2h_qualy + $puntuak_h2h_race + $puntuak_buelta_azkarra + $puntuak_pole + $puntuak_sprint;
        }
    
        

        $registro = PuntuakGidaria::create([
            'gidaria' => $data['gidaria'],
            'gp' => $data['gp'],
            'pos_qualy' => $puntuak_qualy,
            'pos_race' => $puntuak_race,
            'h2h_qualy' => $puntuak_h2h_qualy,
            'h2h_race' => $puntuak_h2h_race,
            'buelta_azkarra' => $puntuak_buelta_azkarra,
            'pole' => $puntuak_pole,
            'sprint' => $puntuak_sprint,
            'puntuak_guztira' => $puntuak_guztira
        ]);

        $gidaria = Gidaria::find($data['gidaria']);
        $gidaria->puntuak = $gidaria->puntuak + $puntuak_guztira; 
        $gidaria->save();

        return response()->json(['message' => 'Puntuak gordeta', 'data' => $registro]);
    }

    public function procesarPuntuakTaldea(Request $request) {

        
        $posizioa_buelta_azkarra = $request->data['buelta_azkarra'] ?? false ? "bai" : "ez";
        $posizioa_pole = $request->data['pole'] ?? false ? "bai" : "ez";

        LasterketaTaldea::create([
            'taldea' => $request->aukeratutakoa,
            'gp' => $request->gp,
            'pos_qualy' => $request->data['pos_qualy'],
            'pos_race' => $request->data['pos_race'],
            'buelta_azkarra' => $posizioa_buelta_azkarra,
            'pole' => $posizioa_pole,
        ]);
        
        $data = [
            'taldea' => $request->aukeratutakoa,
            'gp' => $request->gp,
            'pos_qualy' => $request->data['pos_qualy'],
            'pos_race' => $request->data['pos_race'],
            'buelta_azkarra' => $request->data['buelta_azkarra'],
            'pole' => $request->data['pole']
        ];

        $puntuak_qualy = $this->calcularPuntuacionQualy($data['pos_qualy'] ?? 0);
        $puntuak_race = $this->puntuazioaLasterketaTalde($data['pos_race'] ?? 0);
        $puntuak_buelta_azkarra = $data['buelta_azkarra'] ?? false ? 5 : 0;
        $puntuak_pole = $data['pole'] ?? false ? 5 : 0;

        $puntuak_guztira = $puntuak_qualy + $puntuak_race + $puntuak_buelta_azkarra + $puntuak_pole;

        $registro = PuntuakTaldea::create([
            'taldea' => $data['taldea'],
            'gp' => $data['gp'],
            'pos_qualy' => $puntuak_qualy,
            'pos_race' => $puntuak_race,
            'buelta_azkarra' => $puntuak_buelta_azkarra,
            'pole' => $puntuak_pole,
            'puntuak_guztira' => $puntuak_guztira
        ]);

        $taldea = Taldea::find($data['taldea']);
        $taldea->puntuak = $taldea->puntuak + $puntuak_guztira; 
        $taldea->save();

        return redirect()->back();
    }

private function calcularPuntuacionQualy($pos_qualy)
{

    return $pos_qualy > 0 && $pos_qualy <= 10 ? 11 - $pos_qualy : 0;
}

private function puntuazioaLasterketaGidari($pos_race)
{
    return match ($pos_race) {
        '1' => 25,
        '2' => 20,
        '3' => 18,
        '4' => 16,
        '5' => 15,
        '6' => 12,
        '7' => 10,
        '8' => 8,
        '9' => 6,
        '10' => 5, 
    };
}

private function puntuazioaLasterketaTalde($pos_race)
{
    return match ($pos_race) {
        '1' => 30,
        '2' => 25,
        '3' => 20,
        '4' => 15,
        '5' => 10,
        '6' => 9,
        '7' => 8,
        '8' => 7,
        '9' => 6,
        '10' => 5, 
    };
}

private function puntuazioaSprint($pos_race){

    return match ($pos_race) {
        '1' => 8,
        '2' => 7,
        '3' => 6,
        '4' => 5,
        '5' => 4,
        '6' => 3,
        '7' => 2,
        '8' => 1, 
        null => 0
    };
}

private function puntuakQualyF2($pos_qualy)
{

    return match ($pos_qualy) {
        '1' => 5,
        '2' => 4,
        '3' => 3,
        '4' => 2,
        '5' => 1,
    };
}

private function puntuazioaLasterketaGidariF2($pos_race)
{
    return match ($pos_race) {
        '1' => 16,
        '2' => 12,
        '3' => 10,
        '4' => 8,
        '5' => 6,
        '6' => 5,
        '7' => 4,
        '8' => 3,
        '9' => 2,
        '10' => 1, 
    };
}
public function ligak()
{
    $ligak = Liga::all();

    return response()->json($ligak);

}
public function destroyliga(Request $request){
    $ligaId = $request->id;

    $ligaSelected = Liga::where('id', $ligaId)->first();

    $ligaSelected->delete();

    return redirect()->back();
}
public function editliga(Request $request)
{
    $request->validate([
        'id' => 'required|numeric',
        'izena' => 'required|min:5|max:30',
        'deskribapena' => 'nullable|max:255',
    ]);

    $updateData = [
        'izena' => $request->input('izena'),
        'deskribapena' => $request->input('deskribapena'),
    ];

    if (!$request->has('deskribapena')) {
        unset($updateData['deskribapena']);
    }

    if (!$request->has('izena')) {
        unset($updateData['izena']);
    }

    Liga::where('id', $request->id)->update($updateData);

    return redirect()->back();
}
public function gidariak(Request $request){
    
    $gidariaId = $request->id;

    $gidariak = Gidaria::all();


    return Inertia::render('mainOrriak/adminGidaria', [
        'gidariak' => $gidariak,
        
    ]); 

}
public function deletegidaria(Request $request){
    
    $gidariaId = $request->id;

    $gidaria = Gidaria::where('id', $gidariaId)->first();

    $gidaria->delete();

    return redirect()->back();


}


public function editgidaria(Request $request){
    
    $request->validate([
        'id' => 'required|numeric',
        'izena' => 'required|min:5|max:30',
        'balioa' => 'required|numeric',
        'disponibilitatea' => 'required',
        'kategoria' => 'required',
    ]);
    $disponibilitatea = $request->disponibilitatea ? 'Disponible' : 'No Disponible';

    Gidaria::where('id', $request->id)
    ->update([
        'izena' => $request->izena,
        'balioa' => $request->balioa,
        'disponibilitatea' => $disponibilitatea,
        'kategoria' => $request->kategoria
    ]);


    return redirect()->back();
}



public function bezeroak() {

    $erabiltzaileak = User::all();

    $bezeroak = [];
    foreach ($erabiltzaileak as $erabiltzailea) {
        if ($erabiltzailea->mota === 'bezero') {
            array_push($bezeroak, $erabiltzailea);
        }
    }

    return Inertia::render('mainOrriak/adminBezeroa', [
        'bezeroak' => $bezeroak
    ]);
}

public function deletebezeroa(Request $request){
    
    $bezeroaId = $request->id;

    $bezeroa = User::where('id', $bezeroaId)->first();

    $bezeroa->delete();

    return redirect()->back();


}


public function editbezeroa(Request $request){
    
    $request->validate([
        'id' => 'required|numeric',
        'izena' => 'required|min:2|max:30',
        'email' => 'required',
    ]);

    User::where('id', $request->id)
    ->update([
        'izena' => $request->izena,
        'email' => $request->email
    ]);

    return redirect()->back();
}



public function taldeak() {

    $taldeak = Taldea::all();

    return Inertia::render('mainOrriak/adminTaldea', [
        'taldeak' => $taldeak
    ]);
}
public function deletetaldea(Request $request){
    
    $taldeaId = $request->id;

    $taldea = Taldea::where('id', $taldeaId)->first();

    $taldea->delete();

    return redirect()->back();


}


public function editaldea(Request $request){
    
    $request->validate([
        'id' => 'required|numeric',
        'izena' => 'required|min:5|max:30',
        'balioa' => 'required|numeric',
    ]);

    Taldea::where('id', $request->id)
    ->update([
        'izena' => $request->izena,
        'balioa' => $request->balioa,    
    ]);


    return redirect()->back();
}
}