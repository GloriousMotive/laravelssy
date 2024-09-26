<?php

namespace Tests\Feature\Custom;

use Tests\TestCase;

class RedirectAfterLoginTest extends TestCase
{
    public function test_it_redirects_user_to_dashboard_after_login(): void
    {
        \Illuminate\Support\Facades\DB::table('users')->upsert([
            'name' => 'RedirectAfterLoginTest',
            'email' => 'RedirectAfterLoginTest@test.com',
            'password' => bcrypt('password'),
            'locale' => 'de',
        ], ['email'], ['name', 'email']);

        $response = $this->post('/login', [
            'email' => 'RedirectAfterLoginTest@test.com',
            'password' => 'password',
        ]);

        $response
            ->assertRedirect(route('filament.dashboard.pages.dashboard'));
    }
}
