<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;

class SetLocaleAfterRegistered
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
    public function handle(Registered $event): void
    {
        Log::debug('App\Listeners\SetLocaleAfterRegistered: Save session locale to database');
        $user = $event->user;
        $locale = session('locale');

        // Weist die aus der Session abgerufene Sprache dem Benutzerobjekt zu
        $user->locale = $locale;

        // Speichert die Änderungen am Benutzer in der Datenbank
        $user->save();
    }
}
