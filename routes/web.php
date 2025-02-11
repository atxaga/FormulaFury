<?php

use App\Http\Controllers\AktibitateaController;
use App\Http\Controllers\KlasifikazioaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MerkatuaController;
use App\Http\Controllers\PujaController;
use App\Http\Controllers\TaldeaController;
use App\Http\Controllers\AdminController;
use App\Models\Gidaria;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;



Route::get('/', [LoginController::class, 'index'])->name('login.index');


Route::get('/kontugabe', function () {
    return Inertia::render('mainOrriak/kontugabeMain', []);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/nagusia', [LigaController::class, 'index'])->name('ligak.index');
    Route::post('/ligas', [LigaController::class, 'store'])->name('ligas.store');
    Route::post('/ligaSartu', [LigaController::class, 'sartu'])->name('ligas.sartu');
    Route::get('/merkatua', [MerkatuaController::class, 'index'])->name('merkatua.index');
    Route::get('/klasifikazioa', [KlasifikazioaController::class, 'index'])->name('klasifikazioa.index');
    Route::get('/kontaktua', function () {
        return Inertia::render('mainOrriak/kontaktuaMain', []);
    });
    Route::get('/taldea', [TaldeaController::class, 'index'])->name('taldea');
    Route::get('/gidariak', [TaldeaController::class, 'gidariak'])->name('gidariak');

    Route::post("/pujatu", [PujaController::class, 'store'])->name('puja.store');
    Route::post("/pujatutaldea", [PujaController::class, 'storetaldea'])->name('taldea.store');

    Route::post("/oferta", [TaldeaController::class, 'oferta'])->name('gidaria.oferta');
    Route::post("/ofertataldea", [TaldeaController::class, 'ofertataldea'])->name('taldea.oferta');

    Route::get("/salketak", [MerkatuaController::class, 'salketak'])->name('merkatua.salketak');
    Route::post('/onartu', [TaldeaController::class, 'onartu'])->name('oferta.onartu');
    Route::post('/onartutaldea', [TaldeaController::class, 'onartutaldea'])->name('taldea.onartu');

    Route::post('/ezeztatu', [TaldeaController::class, 'ezeztatu'])->name('oferta.ezeztatu');
    Route::post('/ezeztatutaldea', [TaldeaController::class, 'ezeztatutaldea'])->name('taldea.ezeztatu');
    Route::post('/pujaezabatutaldea', [PujaController::class, 'destroytaldea'])->name('taldea.destroy');

    Route::post('/pujaezabatu', [PujaController::class, 'destroy'])->name('puja.destroy');
    Route::get('/nireoperazioak', [PujaController::class, 'pujatutakoGidari']);
    Route::get('/historikoa', [AktibitateaController::class, 'historikoa'])->name('historikoa.index');
    Route::post('/plantilla', [TaldeaController::class, 'update'])->name('taldea.update');
    Route::get('/puntuak', [TaldeaController::class, 'puntuatu'])->name('taldea.puntuatu');
    Route::get('/aktibitatea', [AktibitateaController::class, 'index'])->name('aktibitatea.index');
    Route::get('/puntuakgehitu', [AdminController::class, 'index'])->name('admin.index');

});
Route::post('/saldu/{id}', [TaldeaController::class, 'saldu'])->name('gidaria.saldu');
Route::post('/saldutaldea/{id}', [TaldeaController::class, 'salduTaldea'])->name('taldea.saldu');

Route::post('/klausulatu/{id}', [TaldeaController::class, 'klausulazo'])->name('gidaria.klausulazo');
Route::post('/klausulatutaldea/{id}', [TaldeaController::class, 'klausulazotaldea'])->name('taldea.klausulazo');

Route::post('/klausulaigo/{id}', [TaldeaController::class, 'klausula'])->name('gidaria.klausula');
Route::post('/klausulaigotaldea/{id}', [TaldeaController::class, 'klausulataldea'])->name('gidaria.klausula');

Route::get('/ikusitaldea', [TaldeaController::class, 'taldeaIkusi'])->name('gidaria.ikusi');
Route::get('/setBezero/{id}', function ($id) {
    session(['aukeratutakoBezeroa' => $id]);
    return redirect()->back();
})->name('setLiga');

Route::get('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/set-locale/{language}', [LanguageController::class, 'setLocale']);
Route::get('/merkatubukaera', [PujaController::class, 'bukaera'])->name('merkatua.bukaera');
Route::get('/setLiga/{id}', function ($id) {
    session(['aukeratutakoLiga' => $id]);
    return redirect()->back();
})->name('setLiga');
Route::post('/abandonarliga/{id}', [LigaController::class, 'abandonarliga'] )->name('ligak.abandonar');
Route::post('gehituPuntuak', [AdminController::class, 'gorde'])->name('admin.gorde');
Route::get('/adminpanel',  function () {
    return Inertia::render('mainOrriak/adminMain', []);
});
Route::post('/destroyliga/{id}', [AdminController::class, 'destroyliga'] )->name('ligak.destroy');
Route::post('/ligaeditatu', [AdminController::class, 'editliga'])->name('ligas.edit');
Route::get('/admingidariak', [AdminController::class, 'gidariak'] )->name('gidariak.admin');
Route::post('/deletegidaria/{id}', [AdminController::class, 'deletegidaria'] )->name('gidaria.destroy');
Route::get('/adminbezeroak', [AdminController::class, 'bezeroak'])->name('admin.bezeroak');
Route::post('/bezeroaeditatu', [AdminController::class, 'editbezeroa'])->name('bezeroa.edit');
Route::post('/deletebezeroa/{id}', [AdminController::class, 'deletebezeroa'] )->name('bezeroa.destroy');
Route::post('/gidariaeditatu', [AdminController::class, 'editgidaria'])->name('gidaria.edit');
Route::get('/admintaldeak', [AdminController::class, 'taldeak'])->name('admin.taldeak');
Route::post('/deletetaldea/{id}', [AdminController::class, 'deletetaldea'] )->name('taldea.destroy');
Route::post('/taldeaeditatu', [AdminController::class, 'editaldea'])->name('taldea.edit');
Route::get('/api/ligak', [AdminController::class, 'ligak'] )->name('ligak.admin');




require __DIR__.'/auth.php';
