<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // 1. Eager load author and tags, and count comments
        $query = Post::where('is_published', true)
            ->with(['author', 'tags'])
            ->withCount('comments');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // 2. Filter by Tag using whereHas
        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        $posts = $query->orderByDesc('is_pinned')
            ->orderByDesc('published_at')
            ->paginate(6)
            ->withQueryString();

        $categories = ['Announcement', 'Health', 'Peace & Order', 'Ayuda', 'Events'];
        $tags = Tag::pluck('name'); // Pass tags to view for the dropdown

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    public function show($id)
    {
        $post = Post::where('is_published', true)->findOrFail($id);
        
        $post->views += 1;
        $post->save();

        // 3. Eager load author, tags, and nested comments with their users
        $post->load(['author', 'tags', 'comments' => function($query) {
            $query->latest(); // Load newest comments first
        }, 'comments.user']);

        return view('posts.show', compact('post'));
    }
    
    public function create()
    {
        $categories = ['Announcement', 'Health', 'Peace & Order', 'Ayuda', 'Events'];
        $tags = Tag::all();
        
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(\App\Http\Requests\StorePostRequest $request)
    {
        $data = $request->validated();
        
        $tags = $data['tags']; // Extract tags
        unset($data['tags']);  // Remove tags before inserting to posts table

        // Handle the checkbox boolean
        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;
        $data['is_pinned'] = false; // default to false for new posts

        // Create the post through the author relationship
        $post = $request->user()->author->posts()->create($data);
        
        // Sync the tags
        $post->tags()->sync($tags);

        return redirect()->route('posts.index')->with('status', 'Post created successfully.');
    }
}