<?php

namespace App\Http\Controllers;

use App\Models\Aktibitatea;
use App\Models\BezeroGidari;
use App\Models\BezeroLiga;
use App\Models\BezeroLigaGidari;

use App\Models\Bezero;
use App\Models\BezeroLigaTalde;
use App\Models\Gidaria;
use App\Models\Taldea;
use App\Models\Liga;
use App\Models\LigaGidari;
use App\Models\LigaTaldea;
use App\Models\Ofertak;
use App\Models\OfertaTaldea;
use App\Models\Plantilla;
use App\Models\Puja;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


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
        
        $taldeak = BezeroLigaTalde::where([
            ['liga_id', '=', $ligaId],
            ['bezeroa_id', '=', $bezeroa->id],
        ])->get(); 
        
        $taldeaIds = $taldeak->pluck('taldea_id')->toArray();

        

        $gidariBezero = Gidaria::whereIn('id', $gidariaIds)
        ->get()
        ->map(function ($gidaria) use ($gidariak, $ligaId) {
            $gidariaData = $gidariak->where('gidaria_id', $gidaria->id)
                                    ->where('liga_id', $ligaId)
                                    ->first();
            $gidaria->gidaria_clausula = $gidariaData ? $gidariaData->gidaria_clausula : null;
            return $gidaria;
        });
        if($taldeak){
            $taldeaBezero = Taldea::whereIn('id', $taldeaIds)
            ->get()

    ->map(function ($taldea) use ($taldeak, $ligaId) {
            $taldeaData = $taldeak->where('taldea_id', $taldea->id)
                                    ->where('liga_id', $ligaId)
                                    ->first();
            $taldea->taldea_clausula = $taldeaData ? $taldeaData->taldea_clausula : null;

            return $taldea;
            
        });
}



        $ekipoBalor = $gidariBezero->sum('balioa');
        $taldeaBezero = $taldeaBezero ?? null;

        if($taldeaBezero){
        $ekipoBalorea = $ekipoBalor+$taldeaBezero->sum('balioa');
        }else{
            $ekipoBalorea = $ekipoBalor;

        }


        return Inertia::render('mainOrriak/gidariakMain', [
            'gidariak' => $gidariBezero,
            'taldea' => $taldeaBezero,
            'bezeroa' => $bezeroIzena,
            'liga' => $liga,
            'ekipoBalorea' => $ekipoBalorea,
            'erabiltzailea' => $request->user()
        ]);  
        

    }

    

    public function index(Request $request){
        $bezero = $request->user()->bezeroa;
        $bezeroa = $request->user()->izena;

        $ligaId = session('aukeratutakoLiga');
        $liga = Liga::find($ligaId);

      

        $pilotos = DB::table('bezeroa_liga_gidaria')
            ->where('bezeroa_id', $bezero->id)
            ->where('liga_id', $ligaId)
            ->get();

        $gidariaIds = $pilotos->pluck('gidaria_id')->toArray();


        $gidariaF1 = [];
        $gidariaF2 = [];
        foreach ($pilotos as $piloto) {
    
            $gidari = DB::table('gidariak') 
                ->where('id', $piloto->gidaria_id)
                ->first();
            
            if ($gidari) {
                $categoria = $gidari->kategoria;
                $data = [
                    'gidari_id' => $gidari->id,
                    'izena' => $gidari->izena,
                    'foto' => $gidari->foto,
                    'aukeratuta' => (bool) $piloto->aukeratuta, 
                ];

                if ($categoria === 'f1') {
                    $gidariaF1[] = $data;
                } elseif ($categoria === 'f2') {
                    $gidariaF2[] = $data;
                }
            }
        }

        $taldeaId = BezeroLigaTalde::where('liga_id', $ligaId)
            ->where('bezeroa_id', $bezero->id)
            ->first();
        if($taldeaId){

        $taldea = Taldea::where('id', $taldeaId->taldea_id)
        ->first();
        $taldeaIzena = $taldea->izena;
        }

        $gidariBezero = Gidaria::whereIn('id', $gidariaIds)->get();
        
        $ekipoBalor = $gidariBezero->sum('balioa');
        $taldea = $taldea ?? null;
        if($taldea){

        $ekipoBalorea = $ekipoBalor+$taldea->balioa;
        }else{
            $ekipoBalorea = $ekipoBalor;

        }



        return Inertia::render('mainOrriak/taldeaMain',[
            'bezeroa' =>$bezeroa,
            'gidariaF1'=> $gidariaF1,
            'gidariaF2' => $gidariaF2,
            'ligaIzena' => $liga->izena,
            'taldeaOsoa' => $taldea,
            'taldeaIzena' => $taldeaIzena ?? null,
            'ligaId' => $liga->id,
            'ekipoBalorea' => $ekipoBalorea,
            'erabiltzailea' => $request->user()
        ]);
    }

    public function puntuatu(Request $request) {

        $ligaId = session('aukeratutakoLiga');
        $liga = Liga::find($ligaId);
        $bezero = $request->user()->bezeroa;
        $bezeroa = $request->user()->izena;

        $gidariak = BezeroLigaGidari::all()
                            ->where('bezeroa_id', $bezero->id)
                            ->where('liga_id', $ligaId)
                            ->where('aukeratuta', 1);
        $gidariaIds = $gidariak->pluck('gidaria_id')->toArray();
        
        $gidariaF1 = [];
        $gidariaF2 = [];
        foreach ($gidariak as $gidaria) {
    
            $gidari = DB::table('gidariak') 
                ->where('id', $gidaria->gidaria_id)
                ->first();
            
            if ($gidari) {
                $categoria = $gidari->kategoria;
                $data = [
                    'gidari_id' => $gidari->id,
                    'izena' => $gidari->izena,
                    'foto' => $gidari->foto,
                ];
                if ($categoria === 'f1') {
                    $gidariaF1[] = $data;
                } elseif ($categoria === 'f2') {
                    $gidariaF2[] = $data;
                }
            }
        }
        
        $taldeaId = BezeroLigaTalde::where('liga_id', $ligaId)
                                    ->where('bezeroa_id', $bezero->id)
                                    ->first();
        $taldea = Taldea::where('id', $taldeaId->taldea_id)
                            ->first();
        if($taldea){
        $taldeaIzena = $taldea->izena;
        }

        $gidariBezero = Gidaria::whereIn('id', $gidariaIds)->get();
        $ekipoBalor = $gidariBezero->sum('balioa');
        $ekipoBalorea = $ekipoBalor+$taldea->balioa;
        
        return Inertia::render('mainOrriak/puntuakMain',[
            'bezeroa' =>$bezeroa,
            'gidariaF1'=> $gidariaF1,
            'gidariaF2' => $gidariaF2,
            'ligaIzena' => $liga->izena,
            'taldeaOsoa' => $taldea,
            'taldeaIzena' => $taldeaIzena,
            'ligaId' => $liga->id,
            'ekipoBalorea' => $ekipoBalorea,
            'erabiltzailea' => $request->user()
        ]);
        
    }

    public function update(Request $request) {
        
            $bezeroId = $request->user()->bezeroa->id; 
            
            $liga = $request->input('ligaId');


            DB::table('bezeroa_liga_gidaria')
                ->where('liga_id', $liga)
                ->where('bezeroa_id', $bezeroId)
                ->update(['aukeratuta' => 0]);
        
            
            $aukeratutakoGidariak = [
                $request->input('gidaria1F1'),
                $request->input('gidaria2F1'),
                $request->input('gidaria1F2'),
                $request->input('gidaria2F2'),
            ];

        
            foreach ($aukeratutakoGidariak as $gidariaId) {
                if ($gidariaId) {
                    DB::table('bezeroa_liga_gidaria')
                        ->where('liga_id', $liga)
                        ->where('bezeroa_id', $bezeroId)
                        ->where('gidaria_id', $gidariaId)
                        ->update(['aukeratuta' => 1]);
                }
            }
        
            return redirect()->back();
    }


    public function saldu(Request $request){
        $bezeroa = $request->user();
        $ligaId = session('aukeratutakoLiga');
        $id = $request->id;

        
            LigaGidari::where('gidaria_id', $id)
        ->where('liga_id', $ligaId)
        ->update([
            'erabilgarritasuna' => 1
        ]);

        $gidaria = Gidaria::findOrFail($id);

        $bezeroaGidari = BezeroLigaGidari::where('gidaria_id', $id)
        ->where('liga_id', $ligaId)
        ->where('bezeroa_id', $bezeroa->id)
        ->first();

        $bezeroaGidari->delete();

        $gidariBalioa = $gidaria->balioa;

        $percentage = 0.20;
        $minValue = $gidariBalioa * (1 - $percentage); 
        $maxValue = $gidariBalioa * (1 + $percentage); 
    
        $randomValue = rand($minValue * 100, $maxValue * 100) / 100;

        BezeroLiga::where('bezeroa_id', $bezeroa->id)
        ->where('liga_id', $ligaId)
        ->increment('dirua', $randomValue);

        Aktibitatea::insert([
            'bezeroa_id' => $bezeroa->id,
            'liga_id' => $ligaId,
            'gidaria_id' => $id,
            'mota' => 'saldu',
            'prezioa' => $randomValue,
            'created_at' => now(),
            'updated_at' => now() 
        ]);
        
        


        

    }
    public function salduTaldea(Request $request){
        $bezeroa = $request->user();
        $ligaId = session('aukeratutakoLiga');
        $id = $request->id;

            LigaTaldea::where('taldea_id', $id)
            ->where('liga_id', $ligaId)
            ->update([
                'erabilgarritasuna' => 1
            ]);
    
            $taldea = Taldea::findOrFail($id);
    
            $bezeroaTaldea = BezeroLigaTalde::where('taldea_id', $id)
            ->where('liga_id', $ligaId)
            ->where('bezeroa_id', $bezeroa->id)
            ->first();
            $bezeroaTaldea->delete();
    
            $taldeaBalioa = $taldea->balioa;
    
            $percentage = 0.20;
            $minValue = $taldeaBalioa * (1 - $percentage); 
            $maxValue = $taldeaBalioa * (1 + $percentage); 
        
            $randomValue = rand($minValue * 100, $maxValue * 100) / 100;
    
            BezeroLiga::where('bezeroa_id', $bezeroa->id)
            ->where('liga_id', $ligaId)
            ->increment('dirua', $randomValue);
    
            Aktibitatea::insert([
                'bezeroa_id' => $bezeroa->id,
                'liga_id' => $ligaId,
                'gidaria_id' => $request->id,
                'mota' => 'saldu',
                'prezioa' => $randomValue,
                'created_at' => now(),
                'updated_at' => now() 
            ]);
            
    
        
    

    }

    public function klausula(Request $request, $gidariaId)
{
    $request->validate([
        'kantitatea' => 'required|numeric|min:1',
    ]);

    $kantitatea = $request->kantitatea;
    $bezeroa = $request->user();
    $ligaId = session('aukeratutakoLiga');


    $gidariaLiga = BezeroLigaGidari::where([
        ['liga_id', '=', $ligaId],
        ['bezeroa_id', '=', $bezeroa->id],
        ['gidaria_id', '=', $gidariaId]
    ])->first();

    

    $bezeroaDirua = BezeroLiga::where('liga_id', $ligaId)
    ->where('bezeroa_id', $bezeroa->id)
    ->first();


    

    if ($bezeroaDirua->dirua < $kantitatea) {
        return redirect()->back()->with('error', 'Ez daukazu nahikoa diru.');
    }

    $bezeroaDirua->dirua -= $kantitatea;
    $bezeroaDirua->save();

    $gidariaLiga->gidaria_clausula += ($kantitatea * 2);
    $gidariaLiga->save();

    return redirect()->back()->with('success', 'Klausula eguneratu da!');
}

public function klausulataldea(Request $request, $gidariaId)
{
    $request->validate([
        'kantitatea' => 'required|numeric|min:1',
    ]);

    $kantitatea = $request->kantitatea;
    $bezeroa = $request->user();
    $ligaId = session('aukeratutakoLiga');


    $taldeaLiga = BezeroLigaTalde::where([
        ['liga_id', '=', $ligaId],
        ['bezeroa_id', '=', $bezeroa->id],
        ['taldea_id', '=', $gidariaId]
    ])->first();

    

    $bezeroaDirua = BezeroLiga::where('liga_id', $ligaId)
    ->where('bezeroa_id', $bezeroa->id)
    ->first();


    

    if ($bezeroaDirua->dirua < $kantitatea) {
        return redirect()->back()->with('error', 'Ez daukazu nahikoa diru.');
    }

    $bezeroaDirua->dirua -= $kantitatea;
    $bezeroaDirua->save();

    $taldeaLiga->taldea_clausula += ($kantitatea * 2);
    $taldeaLiga->save();

    return redirect()->back()->with('success', 'Klausula eguneratu da!');
}

public function taldeaIkusi(Request $request)
{
    $bezeroaId = session('aukeratutakoBezeroa');
    $bezeroaCurrent = $request->user();

    $bezeroa = User::where('id', $bezeroaId)->first();    

    $ligaId = session('aukeratutakoLiga');
    $liga = Liga::find($ligaId);

    $bezeroaDirua = BezeroLiga::where('liga_id', $ligaId)
        ->where('bezeroa_id', $bezeroaCurrent->id)
        ->first();

    // Obtener todos los gidariak asociados al bezeroa
    $gidariakIds = BezeroLigaGidari::where('bezeroa_id', $bezeroaId)
        ->where('liga_id', $ligaId)
        ->pluck('gidaria_id'); 

    $gidariak = BezeroLigaGidari::where([
        ['liga_id', '=', $ligaId],
        ['bezeroa_id', '=', $bezeroaId],
    ])->get();

    // Obtener todos los taldeak asociados al bezeroa
    $taldeaIds = BezeroLigaTalde::where('bezeroa_id', $bezeroaId)
        ->where('liga_id', $ligaId)
        ->pluck('taldea_id');

    // Obtener datos de gidariak con sus cláusulas
    $gidariBezero = Gidaria::whereIn('id', $gidariakIds)
        ->get()
        ->map(function ($gidaria) use ($gidariak, $ligaId) {
            $gidariaData = $gidariak->where('gidaria_id', $gidaria->id)
                                    ->where('liga_id', $ligaId)
                                    ->first();
            $gidaria->gidaria_clausula = $gidariaData ? $gidariaData->gidaria_clausula : null;
            return $gidaria;
        });

    $taldeakData = BezeroLigaTalde::where([
        ['liga_id', '=', $ligaId],
        ['bezeroa_id', '=', $bezeroaId],
    ])->get();


    $taldeak = Taldea::whereIn('id', $taldeaIds)
        ->get()
        ->map(function ($taldea) use ($taldeakData) {
            $taldeaData = $taldeakData->where('taldea_id', $taldea->id)->first();
            $taldea->taldea_clausula = $taldeaData ? $taldeaData->taldea_clausula : null;
            return $taldea;
        });


    $ekipoBalor = $gidariak->sum('balioa');
    $ekipoBalorea = $taldeak ? $ekipoBalor + $taldeak->sum('balioa'): $ekipoBalor;

    return Inertia::render('mainOrriak/gidariakBezero', [
        'gidariak' => $gidariBezero,
        'taldeak' => $taldeak, 
        'bezeroaDirua' => $bezeroaDirua->dirua,
        'ekipoBalorea' => $ekipoBalorea,
        'liga' => $liga,
        'bezeroa' => $bezeroa,
        'erabiltzailea' => $request->user()
    ]);
}

public function klausulazo(Request $request)
{
    $id = $request->id;  
    $ligaId = session('aukeratutakoLiga');  
    $bezeroa = session('aukeratutakoBezeroa'); 
    $bezeroaCurrent = $request->user(); 

    $klausula = BezeroLigaGidari::where('liga_id', $ligaId)
        ->where('gidaria_id', $id)
        ->first();

    if (!$klausula) {
        return;
    }

    $bezeroaAukera = BezeroLiga::where('bezeroa_id', $bezeroaCurrent->id)
        ->where('liga_id', $ligaId)
        ->first();

    if (!$bezeroaAukera) {
        return;
    }

    if ($klausula->gidaria_clausula > $bezeroaAukera->dirua) {
        return response()->json(['message' => 'Fondos insuficientes'], 400);  
    }

    $bezeroaAukera->dirua -= $klausula->gidaria_clausula;
    $bezeroaAukera->save();

    $bezeroaGidaria = BezeroLigaGidari::where('liga_id', $ligaId)
        ->where('bezeroa_id', $bezeroa) 
        ->where('gidaria_id', $id)
        ->first();
    
    BezeroLiga::where('bezeroa_id',$bezeroa)
    ->where('liga_id', $ligaId)
    ->increment('dirua', $klausula->gidaria_clausula);
    
    
    $taldea = BezeroLigaGidari::where('liga_id', $ligaId)
    ->where('bezeroa_id', $bezeroaCurrent->id)
    ->first();

    $bezeroaGidaria->delete();

    BezeroLigaGidari::insert([
        'gidaria_id' => $id,  
        'liga_id' => $ligaId,  
        'bezeroa_id' => $bezeroaCurrent->id,  
        'aukeratuta' => 0,  
        'gidaria_clausula' => $klausula->gidaria_clausula,  
    ]);

    return redirect()->back();  


}
public function klausulazotaldea(Request $request)
{
    $id = $request->id;  
    $ligaId = session('aukeratutakoLiga');  
    $bezeroa = session('aukeratutakoBezeroa'); 
    $bezeroaCurrent = $request->user(); 

    $klausula = BezeroLigaTalde::where('liga_id', $ligaId)
        ->where('taldea_id', $id)
        ->first();

    if (!$klausula) {
        return;
    }

    $bezeroaAukera = BezeroLiga::where('bezeroa_id', $bezeroaCurrent->id)
        ->where('liga_id', $ligaId)
        ->first();

    if (!$bezeroaAukera) {
        return;
    }

    if ($klausula->taldea_clausula > $bezeroaAukera->dirua) {
        return redirect()->back();  
    }

    $bezeroaAukera->dirua -= $klausula->taldea_clausula;
    $bezeroaAukera->save();

    $bezeroaTaldea = BezeroLigaTalde::where('liga_id', $ligaId)
        ->where('bezeroa_id', $bezeroa) 
        ->where('taldea_id', $id)
        ->first();
    
    BezeroLiga::where('bezeroa_id',$bezeroa)
    ->where('liga_id', $ligaId)
    ->increment('dirua', $klausula->taldea_clausula);
    
    
    $taldea = BezeroLigaTalde::where('liga_id', $ligaId)
    ->where('bezeroa_id', $bezeroaCurrent->id)
    ->first();

    $bezeroaTaldea->delete();

    BezeroLigaTalde::insert([
        'taldea_id' => $id,  
        'liga_id' => $ligaId,  
        'bezeroa_id' => $bezeroaCurrent->id,  
        'aukeratuta' => 0,  
        'taldea_clausula' => $klausula->taldea_clausula,  
    ]);

    return redirect()->back();  


}
public function oferta(Request $request){
    $ligaid = session('aukeratutakoLiga');
    $bezeroaManda = $request->user();
    $bezeroaRecibe = session('aukeratutakoBezeroa');

    $request->validate([
        'oferta' => 'required|numeric',
        'gidaria_id' => 'required|numeric',
    ]);

    

    $existingPuja = Ofertak::where([
        ['gidaria_id', '=', $request->gidaria_id],
        ['bezeroa_manda', '=', $bezeroaManda->id], 
        ['bezeroa_recibe', '=', $bezeroaRecibe], 
        ['liga_id', '=', $ligaid],
    ])->first();

    if ($existingPuja) {
        $existingPuja->delete();
    }

    Ofertak::create([
        'oferta' => $request->oferta,
        'gidaria_id' => $request->gidaria_id,
        'bezeroa_manda' => $bezeroaManda->id,
        'bezeroa_recibe' => $bezeroaRecibe,
        'liga_id' => $ligaid,
    ]);

    

    

    

    return redirect()->back();;
}
public function ofertataldea(Request $request){
    $ligaid = session('aukeratutakoLiga');
    $bezeroaManda = $request->user();
    $bezeroaRecibe = session('aukeratutakoBezeroa');

    $request->validate([
        'oferta' => 'required|numeric',
        'taldea_id' => 'required|numeric',
    ]);

    

    $existingPuja = OfertaTaldea::where([
        ['taldea_id', '=', $request->taldea_id],
        ['bezeroa_manda', '=', $bezeroaManda->id], 
        ['bezeroa_recibe', '=', $bezeroaRecibe], 
        ['liga_id', '=', $ligaid],
    ])->first();

    if ($existingPuja) {
        $existingPuja->update([
            'oferta' => $request->oferta
        ]);
    }else{

    OfertaTaldea::create([
        'oferta' => $request->oferta,
        'taldea_id' => $request->taldea_id,
        'bezeroa_manda' => $bezeroaManda->id,
        'bezeroa_recibe' => $bezeroaRecibe,
        'liga_id' => $ligaid,
    ]);
    }
    

    

    return redirect()->back();;
}
public function onartu(Request $request)
{
    $bezeroaCurrent = $request->user();
    $ligaId = session('aukeratutakoLiga');

    $gidariaId = $request->gidaria_id;
    $oferta = $request->oferta;
    $bezeroaMandaId = $request->bezeroa_manda_id;

    $bezeroaMandaLiga = BezeroLiga::where('bezeroa_id', $bezeroaMandaId)
        ->where('liga_id', $ligaId)
        ->first();

  

    $bezeroaMandaLiga->dirua -= $oferta;
    $bezeroaMandaLiga->save();

    $taldeaMand = BezeroLigaGidari::where('bezeroa_id', $bezeroaMandaId)
    ->where('liga_id', $ligaId)
    ->first();

    $taldeaManda = Taldea::where('id', $taldeaMand->taldea_id)
    ->first();




    BezeroLigaGidari::create([
        'bezeroa_id' => $bezeroaMandaId,
        'gidaria_id' => $gidariaId,
        'gidaria_clausula' => $oferta,
        'liga_id' => $ligaId,

    ]);

    $bezeroaCurrentLiga = BezeroLiga::where('bezeroa_id', $bezeroaCurrent->id)
        ->where('liga_id', $ligaId)
        ->first();

    if ($bezeroaCurrentLiga) {
        $bezeroaCurrentLiga->dirua += $oferta;
        $bezeroaCurrentLiga->save();
    }

    BezeroLigaGidari::where('bezeroa_id', $bezeroaCurrent->id)
        ->where('gidaria_id', $gidariaId)
        ->where('liga_id', $ligaId)
        ->delete();

        Ofertak::where('gidaria_id', $gidariaId)
        ->where('bezeroa_manda', $bezeroaMandaId)
        ->where('liga_id', $ligaId)
        ->delete();
    
        Aktibitatea::insert([
            'bezeroa_id' => $bezeroaCurrent->id,
            'liga_id' => $ligaId,
            'gidaria_id' => $gidariaId,
            'mota' => 'saldu',
            'prezioa' => $oferta,
    ]);
    Aktibitatea::insert([
        'bezeroa_id' => $bezeroaMandaId,
        'liga_id' => $ligaId,
        'gidaria_id' => $gidariaId,
        'mota' => 'erosi',
        'prezioa' => $oferta,
]);

    return back()->with('success', 'Eskaintza onartu da!');
}
public function onartutaldea(Request $request)
{
    $bezeroaCurrent = $request->user();
    $ligaId = session('aukeratutakoLiga');
    
    $taldeaId = $request->taldea_id;
    $oferta = $request->oferta;
    $bezeroaMandaId = $request->bezeroa_manda_id;

    $bezeroaMandaLiga = BezeroLiga::where('bezeroa_id', $bezeroaMandaId)
        ->where('liga_id', $ligaId)
        ->first();

  

    $bezeroaMandaLiga->dirua -= $oferta;
    $bezeroaMandaLiga->save();
   




    BezeroLigaTalde::create([
        'bezeroa_id' => $bezeroaMandaId,
        'taldea_id' => $taldeaId,
        'taldea_clausula' => $oferta,
        'liga_id' => $ligaId,

    ]);

    $bezeroaCurrentLiga = BezeroLiga::where('bezeroa_id', $bezeroaCurrent->id)
        ->where('liga_id', $ligaId)
        ->first();

    if ($bezeroaCurrentLiga) {
        $bezeroaCurrentLiga->dirua += $oferta;
        $bezeroaCurrentLiga->save();
    }

    BezeroLigaTalde::where('bezeroa_id', $bezeroaCurrent->id)
        ->where('taldea_id', $taldeaId)
        ->where('liga_id', $ligaId)
        ->delete();

        OfertaTaldea::where('taldea_id', $taldeaId)
        ->where('bezeroa_manda', $bezeroaMandaId)
        ->where('liga_id', $ligaId)
        ->delete();

        Aktibitatea::insert([
            'bezeroa_id' => $bezeroaCurrent->id,
            'liga_id' => $ligaId,
            'taldea_id' => $taldeaId,
            'mota' => 'saldu',
            'prezioa' => $oferta,
    ]);
    Aktibitatea::insert([
        'bezeroa_id' => $bezeroaMandaId,
        'liga_id' => $ligaId,
        'taldea_id' => $taldeaId,
        'mota' => 'erosi',
        'prezioa' => $oferta,
]);

    return back()->with('success', 'Eskaintza onartu da!');
}


public function ezeztatu(Request $request){
    $ligaid = session('aukeratutakoLiga');
    $bezeroaManda = $request->bezeroa_manda_id;
    $gidariaId = $request->gidaria_id;


    Ofertak::where('liga_id', $ligaid)
    ->where('bezeroa_manda', $bezeroaManda)
    ->where('gidaria_id', $gidariaId)
    ->delete();



    
}
public function ezeztatutaldea(Request $request){
    $ligaid = session('aukeratutakoLiga');
    $bezeroaManda = $request->bezeroa_manda_id;
    $taldeaId = $request->taldea_id;


    OfertaTaldea::where('liga_id', $ligaid)
    ->where('bezeroa_manda', $bezeroaManda)
    ->where('gidaria_id', $taldeaId)
    ->delete();



    
}

}
