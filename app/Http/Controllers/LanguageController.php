<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLanguage($locale)
    {
        if (in_array($locale, ['es', 'eu'])) {
            session(['locale' => $locale]);
        }
        return back();
    }

    public function setLocale($language)
    {
        
        if (!in_array($language, ['eu', 'es'])) {
            return response()->json(['error' => 'Idioma no soportado'], 400);
        }

       
        session()->put('locale', $language);
        app()->setLocale($language);

        
        return response()->json([
            'header' => __('header')  
        ]);
    }
}
