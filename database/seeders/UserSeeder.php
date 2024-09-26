<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@pornmgr.com',
            'password' => bcrypt('HalloWelt,2024'),
            'is_admin' => true,
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@pornmgr.com',
            'password' => bcrypt('HalloWelt,2024'),
            'is_admin' => false,
        ]);
    }
}
