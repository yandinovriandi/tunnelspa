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
            'name' => 'Yandi Novriandi',
            'email' => 'yandi@mikrotikbot.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
    }
}
