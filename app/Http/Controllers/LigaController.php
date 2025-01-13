<?php

namespace App\Http\Controllers;

use App\Models\Liga;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LigaController extends Controller
{
    public function index()
{
    $ligak = Liga::all();

    return Inertia::render('mainOrriak/nagusiaMain', [
        'ligak' => $ligak,]);
}
public function store(Request $request)
{
    
    $request->validate([
        'izena' => 'required|min:5|max:30', 
        'deskribapena' => 'nullable|max:255', 
    ]);

    
    do {
        $kodea = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6)); 
    } while (Liga::where('kodea', $kodea)->exists());

   
    $liga = Liga::create([
        'izena' => $request->input('izena'),
        'partaideak' => 0,
        'deskribapena' => $request->input('deskribapena'),
        'kodea' => $kodea,
        'klausulak' => $request->input('klasulazo'),
    ]);

    
    $bezeroa = $request->user()->bezeroa;

    \Illuminate\Support\Facades\DB::table('bezeroa_liga')->insert([
    'puntuak' => 0,
    'bezeroa_id' => $bezeroa->id,
    'liga_id' => $liga->id,
]);


    
    return redirect()->route('ligak.index')->with('success', 'Liga sortu da! Kodedea: ' . $kodea);
}


    
}
