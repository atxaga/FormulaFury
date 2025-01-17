<?php

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
});

Route::get('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/set-locale/{language}', [LanguageController::class, 'setLocale']);

Route::get('/setLiga/{id}', function ($id) {
    session(['aukeratutakoLiga' => $id]);
    return redirect()->back();
})->name('setLiga');




require __DIR__.'/auth.php';
