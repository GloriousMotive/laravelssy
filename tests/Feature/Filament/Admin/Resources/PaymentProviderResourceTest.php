<?php

namespace Tests\Feature\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PaymentProviderResource;
use Tests\Feature\FeatureTest;

class PaymentProviderResourceTest extends FeatureTest
{
    public function test_list(): void
    {
        $user = $this->createAdminUser();
        $this->actingAs($user);

        $response = $this->get(PaymentProviderResource::getUrl('index', [], true, 'admin'))->assertSuccessful();

        $response->assertStatus(200);
    }
}
