<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $supportedLocales = ['en', 'lv'];

        $requestedLocale = $request->query('lang');
        if (is_string($requestedLocale) && in_array($requestedLocale, $supportedLocales, true)) {
            $request->session()->put('locale', $requestedLocale);
            app()->setLocale($requestedLocale);

            $query = $request->query();
            unset($query['lang']);

            $url = $request->url();
            if (!empty($query)) {
                $url .= '?' . http_build_query($query);
            }

            return redirect()->to($url);
        }

        $locale = $request->session()->get('locale');

        if (!$locale && $request->user()) {
            $locale = $request->user()->locale ?? null;
        }

        if (!$locale) {
            $locale = config('app.locale', 'en');
        }

        if (!in_array($locale, $supportedLocales, true)) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        if ($request->session()->get('locale') !== $locale) {
            $request->session()->put('locale', $locale);
        }

        return $next($request);
    }
}
