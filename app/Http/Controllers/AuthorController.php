<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function show(Author $author)
    {
        // Get published posts and count all received comments via hasManyThrough
        $posts = $author->posts()->where('is_published', true)->latest('published_at')->get();
        $commentsReceived = $author->comments()->count();

        return view('authors.show', compact('author', 'posts', 'commentsReceived'));
    }
}