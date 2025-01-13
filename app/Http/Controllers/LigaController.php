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

        $liga = Liga::create([
            'izena' => $request->input('izena'),
            'partaideak' => 0,
            'deskribapena' => $request->input('deskribapena'),

        ]);

        return redirect()->route('ligak.index')->with('success', 'Liga sortu da!');
    }

    
}
