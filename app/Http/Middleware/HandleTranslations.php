<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HandleTranslations
{
    public function handle(Request $request, Closure $next)
    {
        
        Inertia::share([
            'translations' => function () {
                return __('mezuak'); 
            },
            'locale' => function () {
                return app()->getLocale();
            },
        ]);

        return $next($request);
    }
}

