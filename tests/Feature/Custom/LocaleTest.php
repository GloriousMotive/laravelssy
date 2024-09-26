<?php

namespace Tests\Feature\Custom;

use Tests\TestCase;

class LocaleTest extends TestCase
{
    public function test_root_redirects_to_default_locale(): void
    {
        $response = $this->get('/');

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/en')
            ->assertSessionHas('locale', 'en');
    }

    public function test_root_redirects_to_browser_preferred_language(): void
    {
        $response = $this->withHeaders([
            'Accept-Language' => 'de-CH, fr;q=0.9, en;q=0.8, de;q=0.7, *;q=0.5'
        ])->get('/');

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/de')
            ->assertSessionHas('locale', 'de');
    }

    public function test_root_redirects_to_fallback_locale_when_xx_is_preferred(): void
    {
        $response = $this->withHeaders([
            'Accept-Language' => 'xx-CH, en;q=0.9, de;q=0.8'
        ])->get('/');

        $fallbackLocale = config('app.fallback_locale');

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect("/$fallbackLocale")
            ->assertSessionHas('locale', $fallbackLocale);
    }

    public function test_xx_route_returns_404(): void
    {
        $response = $this->get('/xx');

        $response
            ->assertStatus(404);
    }

    public function test_change_locale_to_de()
    {
        $response = $this->get('/locale/de');

        $response
            ->assertSessionHasNoErrors()
            ->assertSessionHas('locale', 'de');
    }

    public function test_change_locale_to_xx_returns_404()
    {
        $response = $this->get('/locale/xx');

        $response
            ->assertStatus(404);
    }

    /*
    public function test_set_locale_to_database_after_register()
    {
        $response = $this->get('/de');

        $response->assertSessionHas('locale', 'de');

        $response = $this->post('/register', [
            'name' => 'LocaleTestA',
            'email' => 'LocaleTestA@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'LocaleTestA@test.com',
            'locale' => 'de',
        ]);

        $this->assertAuthenticated();
    }
    */

    public function test_set_locale_from_database_after_login()
    {
        \Illuminate\Support\Facades\DB::table('users')->upsert([
            'name' => 'LocaleTestB',
            'email' => 'LocaleTestB@test.com',
            'password' => bcrypt('password'),
            'locale' => 'de',
        ], ['email'], ['name', 'email']);

        $response = $this->post('/login', [
            'email' => 'LocaleTestB@test.com',
            'password' => 'password',
        ]);

        $response
            ->assertSessionHas('locale', 'de');
    }
}
