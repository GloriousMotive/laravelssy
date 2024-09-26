<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::debug('App\Http\Middleware\SetLocale: Set locale from url, session, accept-language header oder fallback');

        // Versuche, die Locale aus der URL zu bekommen
        $locale = $request->route('locale');

        if ($locale) {
            // Wenn eine Locale aus der URL da ist, prüfe ob diese der session entspricht und setze sie
            if (!session()->has('locale') || session('locale') !== $locale) {
                // Überprüfen, ob die URL-Locale in den verfügbaren Sprachen konfiguriert ist
                if (!in_array($locale, config('app.available_locales'))) {
                    // Falls die Sprache nicht verfügbar ist, setze diese aus der session und nim sonst die fallback.
                    $locale = session()->has('locale') ? session('locale') : config('app.fallback_locale');
                    // Setzt Standardwerte für URL-Generierungen
                    \Illuminate\Support\Facades\URL::defaults(['locale' => $locale]);
                    // Zeige einen 404
                    abort(404);
                }

                // Setze die Sprache in der Session
                session(['locale' => $locale]);
            }
        } elseif (session()->has('locale')) {
            // Falls keine URL-Locale vorhanden ist, benutze die Sprache aus der Session
            $locale = session('locale');
        } else {
            // Fallback auf den Accept-Language Header oder die Fallback-Sprache
            $acceptLang = $request->header('Accept-Language', config('app.fallback_locale'));
            $locale = substr($acceptLang, 0, 2);

            // Überprüfen, ob die extrahierte Sprache verfügbar ist
            if (!in_array($locale, config('app.available_locales'))) {
                // Setze die Fallback-Sprache, wenn die extrahierte Sprache ungültig ist
                $locale = config('app.fallback_locale');
            }

            // Setze die Sprache in der Session
            session(['locale' => $locale]);
        }

        // Setzt Standardwerte für URL-Generierungen, sodass die URLs immer die aktuelle Sprache enthalten
        \Illuminate\Support\Facades\URL::defaults(['locale' => $locale]);

        // Setze die Anwendungssprache auf den ermittelten Wert
        app()->setLocale($locale);

        return $next($request);
    }
}
