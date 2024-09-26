<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocaleController extends Controller
{
    public function redirect(Request $request)
    {
        Log::debug('App\Http\Controllers\LocaleController: Redirect to locale prefi');

        // Weiterleiten wenn die Root route aufgerufen wird
        $locale = app()->getLocale();

        return redirect('/' . $locale, 301);
    }

    public function change(Request $request, $locale = null)
    {
        Log::debug('App\Http\Controllers\LocaleController: Change locale');

        // Holen der gewünschten Sprache aus der Anfrage
        if (!$locale) {
            $locale = $request->input('locale');
        }

        // Überprüfen, ob die Sprache in den verfügbaren Sprachen enthalten ist
        if (!in_array($locale, config('app.available_locales'))) {
            abort(404);
        }

        // Sprache in der Session speichern und global setzen
        session(['locale' => $locale]);
        app()->setLocale($locale);

        // Wenn der Benutzer eingeloggt ist, die Sprache im Profil speichern
        if (auth()->user()) {
            auth()->user()->update(['locale' => $locale]);
        }

        // Zurück zur vorherigen Seite
        return redirect()->back();
    }
}
