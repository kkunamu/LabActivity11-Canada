@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $author->name }}</h1>
        <p class="text-lg text-gray-600 mb-4">{{ $author->position }}</p>
        <div class="inline-flex gap-4 bg-gray-50 px-6 py-3 rounded-lg border border-gray-100">
            <div class="text-center"><span class="block font-bold text-xl text-[#990000]">{{ $posts->count() }}</span> <span class="text-sm text-gray-500 font-medium">Posts</span></div>
            <div class="w-px bg-gray-300"></div>
            <div class="text-center"><span class="block font-bold text-xl text-[#990000]">{{ $commentsReceived }}</span> <span class="text-sm text-gray-500 font-medium">Comments Received</span></div>
        </div>
    </div>

    <h2 class="text-xl font-bold text-gray-900 mb-4">Published Posts</h2>
    <div class="grid grid-cols-1 gap-4">
        @foreach($posts as $post)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:border-[#990000]/30 transition-colors">
                <h3 class="text-lg font-bold"><a href="{{ route('posts.show', $post->id) }}" class="text-gray-800 hover:text-[#990000]">{{ $post->title }}</a></h3>
                <p class="text-sm text-gray-500 mt-2">{{ $post->published_at->format('M d, Y') }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection