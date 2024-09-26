<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetLocaleAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        Log::debug('App\Listeners\SetLocaleAfterLogin: Set locale to session from database');

        $user = $event->user;
        $locale = $user->locale;

        // Setze die Sprache in der Session
        session(['locale' => $locale]);

        // Setzt Standardwerte für URL-Generierungen, sodass die URLs immer die aktuelle Sprache enthalten
        \Illuminate\Support\Facades\URL::defaults(['locale' => $locale]);

        // Setze die Anwendungssprache auf den ermittelten Wert
        app()->setLocale($locale);
    }
}
