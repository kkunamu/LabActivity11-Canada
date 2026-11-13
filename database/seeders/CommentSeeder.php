<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        $lola = \App\Models\User::where('email', 'lola.canada@bulletin.test')->first();
        $publishedPosts = \App\Models\Post::where('is_published', true)->get();

        foreach ($publishedPosts as $post) {
            if ($post->is_pinned) {
                // Pinned post gets 2 random comments + 1 from Lola (3 total)
                \App\Models\Comment::factory()->count(2)->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                ]);
                
                \App\Models\Comment::create([
                    'post_id' => $post->id,
                    'user_id' => $lola->id,
                    'body' => 'Salamat sa pag-update, Kagawad!',
                ]);
            } else {
                // Other published posts get 0-5 comments
                $numComments = rand(0, 5);
                for ($i = 0; $i < $numComments; $i++) {
                    \App\Models\Comment::factory()->create([
                        'post_id' => $post->id,
                        'user_id' => $users->random()->id,
                    ]);
                }
            }
        }
    }
}
