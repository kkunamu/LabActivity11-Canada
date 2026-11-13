<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()->where('is_published', true);

        // Filter by search query if 'q' is filled
        if ($request->filled('q')) {
            $query->where('title', 'LIKE', '%' . $request->q . '%');
        }

        // Filter by category if 'category' is filled
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply sorting and pagination (6 per page for Cañada)
        $posts = $query->orderByDesc('is_pinned')
                       ->latest('published_at')
                       ->paginate(6)
                       ->withQueryString();

        // Get unique categories for the dropdown
        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        // Load the post or return 404 if it doesn't exist
        $post = Post::findOrFail($id);
        
        // Drafts must return 404
        if (!$post->is_published) {
            abort(404);
        }

        // Add 1 to views and save
        $post->views++;
        $post->save();

        return view('posts.show', compact('post'));
    }
}