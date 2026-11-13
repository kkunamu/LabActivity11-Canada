<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = \App\Models\Author::all();

        \App\Models\Post::factory()->count(40)
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        \App\Models\Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        \App\Models\Post::create([
            'author_id' => \App\Models\Author::where('email', 'kagawad.canada@bulletin.test')->first()->id,
            'title' => 'Purok Cañada Clean-up Drive',
            'category' => 'Announcement',
            'body' => 'Please join us for the community clean-up drive.',
            'is_published' => true,
            'is_pinned' => true,
            'published_at' => '2026-08-12 08:00:00',
        ]);
    }
}
