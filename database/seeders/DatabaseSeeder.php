<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->callOnce([
            IntervalsSeeder::class,
            CurrenciesSeeder::class,
            OAuthLoginProviderSeeder::class,
            PaymentProvidersSeeder::class,
            RolesAndPermissionsSeeder::class,
            EmailProviderSeeder::class,
            UserSeeder::class,
            ProductsPlansAndPricesSeeder::class,
            ClearStorageSeeder::class,
        ]);
    }
}
