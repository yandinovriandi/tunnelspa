<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserBalace extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\UserBalace::create([
            'user_id' => 1,
            'balance' => 100000,
        ]);
    }
}
