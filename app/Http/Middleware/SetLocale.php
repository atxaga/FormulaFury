<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->get('locale', session('locale', config('app.locale')));

        // Establecer el idioma en Laravel
        app()->setLocale($locale);

        // Guardar el idioma en sesión
        session(['locale' => $locale]);

        return $next($request);
    }
}
