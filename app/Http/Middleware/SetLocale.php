<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public const SUPPORTED_LOCALES = ['id', 'en', 'zh', 'ja'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->query('lang')
            ?: $request->session()->get('locale')
            ?: $request->cookie('baliguard_locale')
            ?: config('app.locale', 'id');

        if (!in_array($locale, self::SUPPORTED_LOCALES, true)) {
            $locale = 'id';
        }

        app()->setLocale($locale);
        $request->session()->put('locale', $locale);

        $response = $next($request);

        if ($request->query('lang') || !$request->hasCookie('baliguard_locale')) {
            $response->headers->setCookie(cookie('baliguard_locale', $locale, 60 * 24 * 60));
        }

        return $response;
    }
}
