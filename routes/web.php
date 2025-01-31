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
    Route::post('/pujaezabatu', [PujaController::class, 'destroy'])->name('puja.destroy');
    Route::get('/nireoperazioak', [PujaController::class, 'pujatutakoGidari']);
    Route::get('/historikoa', [AktibitateaController::class, 'historikoa'])->name('historikoa.index');
    Route::post('/plantilla', [TaldeaController::class, 'update'])->name('taldea.update');
    Route::get('/puntuak', [TaldeaController::class, 'puntuatu'])->name('taldea.puntuatu');
    Route::get('/aktibitatea', [AktibitateaController::class, 'index'])->name('aktibitatea.index');
    Route::get('/puntuakgehitu', function () {
        return Inertia::render('mainOrriak/puntuakgehituMain', []);
    });

});
Route::post('/saldu/{id}', [TaldeaController::class, 'saldu'])->name('gidaria.saldu');
Route::post('/klausulaigo/{id}', [TaldeaController::class, 'klausula'])->name('gidaria.klausula');
Route::post('/gidariakbezero/{id}', [TaldeaController::class, 'taldeaIkusi'])->name('gidaria.ikusi');

Route::get('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/set-locale/{language}', [LanguageController::class, 'setLocale']);
Route::get('/merkatubukaera', [PujaController::class, 'bukaera'])->name('merkatua.bukaera');
Route::get('/setLiga/{id}', function ($id) {
    session(['aukeratutakoLiga' => $id]);
    return redirect()->back();
})->name('setLiga');




require __DIR__.'/auth.php';
