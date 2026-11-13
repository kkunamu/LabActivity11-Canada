<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Author::create([
            'name' => 'Kagawad Rainzy Cañada',
            'position' => 'Kagawad',
            'email' => 'kagawad.canada@bulletin.test'
        ]);

        \App\Models\Author::factory()->count(4)->create();
    }
}
