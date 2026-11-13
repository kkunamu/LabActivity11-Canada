<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create the 5 required tags
        $tags = collect(['Purok Cañada', 'Urgent', 'Libre', 'Schedule', 'Events'])->map(function ($name) {
            return \App\Models\Tag::create(['name' => $name]);
        });

        $purokTag = \App\Models\Tag::where('name', 'Purok Cañada')->first();
        $urgentTag = \App\Models\Tag::where('name', 'Urgent')->first();

        // 2. Attach tags to posts
        $posts = \App\Models\Post::all();
        foreach ($posts as $post) {
            if ($post->is_pinned) {
                // Pinned post must have exactly these two
                $post->tags()->sync([$purokTag->id, $urgentTag->id]);
            } else {
                // Random 1-3 tags for others
                $randomTagIds = $tags->random(rand(1, 3))->pluck('id');
                $post->tags()->attach($randomTagIds);
            }
        }
    }
}
