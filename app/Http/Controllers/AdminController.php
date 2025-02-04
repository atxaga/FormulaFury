<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gidaria;
use App\Models\GrandPrix;
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
            'puntuak_guztira' => $puntuak_guztira
        ]);

        $gidaria = Gidaria::find($data['gidaria']);
        $gidaria->puntuak = $gidaria->puntuak + $puntuak_guztira; 
        $gidaria->save();

        return response()->json(['message' => 'Puntuak gordeta', 'data' => $registro]);
    }

    public function procesarPuntuakTaldea(Request $request) {
        
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
}