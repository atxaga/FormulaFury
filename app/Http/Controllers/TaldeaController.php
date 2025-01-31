<?php

namespace App\Http\Controllers;

use App\Models\Aktibitatea;
use App\Models\BezeroGidari;
use App\Models\BezeroLiga;
use App\Models\BezeroLigaGidari;
use App\Models\Gidaria;
use App\Models\Taldea;
use App\Models\Liga;
use App\Models\LigaGidari;
use App\Models\Plantilla;
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
        
        $taldea = BezeroLigaGidari::where([
            ['liga_id', '=', $ligaId],
            ['bezeroa_id', '=', $bezeroa->id],
        ])->first(); 
        
        if ($taldea) {
            $taldeaBezero = Taldea::where('id', $taldea->taldea_id)->first();
        }

        $gidariBezero = Gidaria::whereIn('id', $gidariaIds)
        ->get()
        ->map(function ($gidaria) use ($gidariak, $ligaId) {
            $gidariaData = $gidariak->where('gidaria_id', $gidaria->id)
                                    ->where('liga_id', $ligaId)
                                    ->first();
            $gidaria->gidaria_clausula = $gidariaData ? $gidariaData->gidaria_clausula : null;
            return $gidaria;
        });

        $ekipoBalor = $gidariBezero->sum('balioa');
        $ekipoBalorea = $ekipoBalor+$taldeaBezero->balioa;


        return Inertia::render('mainOrriak/gidariakMain', [
            'gidariak' => $gidariBezero,
            'taldea' => $taldeaBezero,
            'bezeroa' => $bezeroIzena,
            'liga' => $liga,
            'ekipoBalorea' => $ekipoBalorea,

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

        $taldeaId = BezeroLigaGidari::where('liga_id', $ligaId)
            ->where('bezeroa_id', $bezero->id)
            ->first();
        $taldea = Taldea::where('id', $taldeaId->taldea_id)
        ->first();
        $taldeaIzena = $taldea->izena;

        $gidariBezero = Gidaria::whereIn('id', $gidariaIds)->get();
        
        $ekipoBalor = $gidariBezero->sum('balioa');
        $ekipoBalorea = $ekipoBalor+$taldea->balioa;



        return Inertia::render('mainOrriak/taldeaMain',[
            'bezeroa' =>$bezeroa,
            'gidariaF1'=> $gidariaF1,
            'gidariaF2' => $gidariaF2,
            'ligaIzena' => $liga->izena,
            'taldeaOsoa' => $taldea,
            'taldeaIzena' => $taldeaIzena,
            'ligaId' => $liga->id,
            'ekipoBalorea' => $ekipoBalorea,
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
        
        $taldeaId = BezeroLigaGidari::where('liga_id', $ligaId)
                                    ->where('bezeroa_id', $bezero->id)
                                    ->first();
        $taldea = Taldea::where('id', $taldeaId->taldea_id)
                            ->first();
        $taldeaIzena = $taldea->izena;

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
public function taldeaIkusi(Request $request)
{
    $bezeroaId = $request->id;

    $bezeroa = User::where('id', $request->id)
    ->first();    

    $ligaId = session('aukeratutakoLiga');
    $liga = Liga::find($ligaId);
    
    $gidariakIds = BezeroLigaGidari::where('bezeroa_id', $bezeroaId)
        ->where('liga_id', $ligaId)
        ->pluck('gidaria_id'); 
    $taldeaId = BezeroLigaGidari::where('bezeroa_id', $bezeroaId)
        ->where('liga_id', $ligaId)
        ->first(); 
    
    $gidariak = Gidaria::whereIn('id', $gidariakIds)->get();

    $taldea = Taldea::where('id', $taldeaId->taldea_id)
        ->first();

    $ekipoBalor = $gidariak->sum('balioa');
    $ekipoBalorea = $ekipoBalor + $taldea->balioa;

    
    return Inertia::render('mainOrriak/gidariakBezero', [
        'gidariak' => $gidariak,
        'taldea' => $taldea,
        'ekipoBalorea' => $ekipoBalorea,
        'liga' => $liga,
        'bezeroa' => $bezeroa,
    ]);
}


}
