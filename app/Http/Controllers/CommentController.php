<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post)
    {
        $post->comments()->create([
            'body' => $request->validated('body'),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('posts.show', $post->id)->with('status', 'Comment posted.');
    }
}