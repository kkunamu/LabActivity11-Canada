<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Lola Cañada
        \App\Models\User::create([
            'name' => 'Lola Cañada',
            'email' => 'lola.canada@bulletin.test',
            'password' => \Illuminate\Support\Facades\Hash::make('bulletin2026'),
        ]);

        // 2. Create your Kagawad User
        $kagawadUser = \App\Models\User::create([
            'name' => 'Kagawad Rainzy Cañada',
            'email' => 'kagawad.canada@bulletin.test',
            'password' => \Illuminate\Support\Facades\Hash::make('bulletin2026'),
        ]);

        // 3. Link the User login to the Author profile
        $author = \App\Models\Author::where('email', 'kagawad.canada@bulletin.test')->first();
        if ($author) {
            $author->update(['user_id' => $kagawadUser->id]);
        }

        // 4. Create 8 more random resident users
        \App\Models\User::factory()->count(8)->create();
    }
}
