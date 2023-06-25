<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFactory::new([
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'email' => 'system@system.com',
            'password' => bcrypt('system@secret'),
            'username' => 'system_administrator',
            'user_type' => 'admin'
        ])->create();

        UserFactory::new()
            ->count(5)
            ->create();
    }
}
