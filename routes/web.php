<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\MerkatuaController;
use App\Http\Controllers\PujaController;
use App\Models\Gidaria;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;



Route::get('/', function () {
    return Inertia::render('mainOrriak/loginMain', []);
});

Route::get('/nagusia', [LigaController::class, 'index'])->name('ligak.index');

Route::post('/ligas', [LigaController::class, 'store'])->name('ligas.store');

Route::get('/merkatua', [MerkatuaController::class, 'index'])->name('merkatua.index');

Route::get('/kontugabe', function () {
    return Inertia::render('mainOrriak/kontugabeMain', []);
});

Route::get('/klasifikazioa', function () {
    return Inertia::render('mainOrriak/klasifikazioaMain', []);
});

Route::get('/kontaktua', function () {
    return Inertia::render('mainOrriak/kontaktuaMain', []);
});

Route::get('/taldea', function () {
    return Inertia::render('mainOrriak/taldeaMain', []);
});
Route::get('/gidariak', function () {
    return Inertia::render('mainOrriak/gidariakMain', []);
});
Route::post("/pujatu", [PujaController::class, 'store'])->name('puja.store');

Route::post('/pujaezabatu', [PujaController::class, 'destroy'])->name('puja.destroy');

Route::get('/nireoperazioak', [PujaController::class, 'pujatutakoGidari']);

Route::get("/bilatzailea", [MerkatuaController::class, 'gidariGuztiak']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/set-locale/{language}', [LanguageController::class, 'setLocale']);



require __DIR__.'/auth.php';
