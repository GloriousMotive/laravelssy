<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Product;
use App\Models\PlanPrice;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsPlansAndPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Free
        $freeProduct = Product::create([
            'name' => 'Free',
            'description' => 'Subscription Product Free Description',
            'slug' => 'free',
            'features' => [['feature' => '2G storage space']],
            'is_popular' => false,
            'is_default' => true,
            'metadata' => [
                'product_title' => 'Free',
                'storage_space_in_gigabytes' => '2'
            ],
        ]);


        // Basic
        $basicProduct = Product::create([
            'name' => 'Basic',
            'description' => 'Subscription Product Basic Description',
            'slug' => 'basic',
            'features' => [['feature' => '10G storage space']],
            'is_popular' => false,
            'is_default' => false,
            'metadata' => [
                'product_title' => 'Basic',
                'storage_space_in_gigabytes' => '10'
            ],
        ]);

        $basicPlanMonthly = Plan::create([
            'name' => 'Basic Monthly',
            'description' => '<p>Plan Basic Monthly Description</p>',
            'slug' => 'basic-monthly',
            'product_id' => $basicProduct->id,
            'interval_id' => 3,
            'interval_count' => 1,
            'has_trial' => false,
            'trial_interval_id' => null,
            'trial_interval_count' => null,
            'is_active' => true,
        ]);

        PlanPrice::create([
            'plan_id' => $basicPlanMonthly->id,
            'price' => 490,
            'currency_id' => 96,
        ]);

        $basicPlanYearly = Plan::create([
            'name' => 'Basic Yearly',
            'description' => '<p>Plan Basic Yearly Description</p>',
            'slug' => 'basic-yearly',
            'product_id' => $basicProduct->id,
            'interval_id' => 4,
            'interval_count' => 1,
            'has_trial' => false,
            'trial_interval_id' => null,
            'trial_interval_count' => null,
            'is_active' => true,
        ]);

        PlanPrice::create([
            'plan_id' => $basicPlanYearly->id,
            'price' => 5292,
            'currency_id' => 96,
        ]);

        // Pro
        $proProduct = Product::create([
            'name' => 'Pro',
            'description' => 'Subscription Product Pro Description',
            'slug' => 'pro',
            'features' => [['feature' => '100G storage space']],
            'is_popular' => true,
            'is_default' => false,
            'metadata' => [
                'product_title' => 'Pro',
                'storage_space_in_gigabytes' => '100'
            ],
        ]);

        $proPlanMonthly = Plan::create([
            'name' => 'Pro Monthly',
            'description' => '<p>Plan Pro Monthly Description</p>',
            'slug' => 'pro-monthly',
            'product_id' => $proProduct->id,
            'interval_id' => 3,
            'interval_count' => 1,
            'has_trial' => false,
            'trial_interval_id' => null,
            'trial_interval_count' => null,
            'is_active' => true,
        ]);

        PlanPrice::create([
            'plan_id' => $proPlanMonthly->id,
            'price' => 1490,
            'currency_id' => 96,
        ]);

        $proPlanYearly = Plan::create([
            'name' => 'Pro Yearly',
            'description' => '<p>Plan Pro Yearly Description</p>',
            'slug' => 'pro-yearly',
            'product_id' => $proProduct->id,
            'interval_id' => 4,
            'interval_count' => 1,
            'has_trial' => false,
            'trial_interval_id' => null,
            'trial_interval_count' => null,
            'is_active' => true,
        ]);

        PlanPrice::create([
            'plan_id' => $proPlanYearly->id,
            'price' => 16092,
            'currency_id' => 96,
        ]);

        // Ultimate
        $ultimateProduct = Product::create([
            'name' => 'Ultimate',
            'description' => 'Subscription Product Ultimate Description',
            'slug' => 'ultimate',
            'features' => [['feature' => '1000G storage space']],
            'is_popular' => false,
            'is_default' => false,
            'metadata' => [
                'product_title' => 'Ultimate',
                'storage_space_in_gigabytes' => '1000'
            ],
        ]);

        $ultimatePlanMonthly = Plan::create([
            'name' => 'Ultimate Monthly',
            'description' => '<p>Plan Ultimate Monthly Description</p>',
            'slug' => 'ultimate-monthly',
            'product_id' => $ultimateProduct->id,
            'interval_id' => 3,
            'interval_count' => 1,
            'has_trial' => false,
            'trial_interval_id' => null,
            'trial_interval_count' => null,
            'is_active' => true,
        ]);

        PlanPrice::create([
            'plan_id' => $ultimatePlanMonthly->id,
            'price' => 2990,
            'currency_id' => 96,
        ]);

        $ultimatePlanYearly = Plan::create([
            'name' => 'Ultimate Yearly',
            'description' => '<p>Plan Ultimate Yearly Description</p>',
            'slug' => 'ultimate-yearly',
            'product_id' => $ultimateProduct->id,
            'interval_id' => 4,
            'interval_count' => 1,
            'has_trial' => false,
            'trial_interval_id' => null,
            'trial_interval_count' => null,
            'is_active' => true,
        ]);

        PlanPrice::create([
            'plan_id' => $ultimatePlanYearly->id,
            'price' => 32292,
            'currency_id' => 96,
        ]);
    }
}
