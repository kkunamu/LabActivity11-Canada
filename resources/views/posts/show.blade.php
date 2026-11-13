@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('posts.index') }}" class="inline-flex items-center text-gray-500 hover:text-[#990000] font-medium text-sm mb-6 transition-colors">
        &larr; Back to Bulletin
    </a>
    
    <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative mt-2">
        <div class="bg-gray-50/50 border-b border-gray-100 p-8 relative">
            @if($post->is_pinned)
                <span class="absolute top-8 right-8 bg-[#990000] text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">Pinned</span>
            @endif
            
            <div class="mb-4 flex flex-wrap gap-2">
                <span class="inline-block bg-white border border-gray-200 text-gray-600 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">{{ $post->category }}</span>
                @foreach($post->tags as $tag)
                    <span class="inline-block bg-red-50 border border-red-100 text-[#990000] text-xs font-medium px-3 py-1.5 rounded-lg shadow-sm">{{ $tag->name }}</span>
                @endforeach
            </div>
            
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2 pr-16 leading-tight">{{ $post->title }}</h1>
            <p class="text-gray-600 mb-6 font-medium">By <a href="{{ route('authors.show', $post->author->id) }}" class="text-[#990000] hover:underline">{{ $post->author->name }}</a></p>
            
            <div class="flex flex-wrap gap-3 text-sm text-gray-500 font-medium">
                <span>Published: {{ $post->published_at->format('M d, Y') }}</span>
                <span>&bull;</span>
                <span>👁 {{ $post->views }} views</span>
            </div>
        </div>
        
        <div class="p-8 text-gray-700 text-lg leading-relaxed whitespace-pre-wrap">{{ $post->body }}</div>
    </article>

    <!-- Comments Section -->
    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Comments ({{ $post->comments->count() }})</h3>
        
        <!-- Comment Form -->
        <div class="mb-8 border-b border-gray-100 pb-8">
            @auth
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                        <strong>Hold up!</strong> Please fix the errors below.
                        <ul class="mt-1 ml-4 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('comments.store', $post->id) }}">
                    @csrf
                    <div class="mb-3">
                        <textarea name="body" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-[#990000]/20 focus:border-[#990000] transition-all" placeholder="Leave a comment...">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-[#990000] text-white font-medium px-6 py-2 rounded-lg hover:bg-red-800 transition-colors">Post Comment</button>
                </form>
            @else
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                    <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-[#990000] font-bold hover:underline">Sign in</a> to leave a comment.</p>
                </div>
            @endauth
        </div>

        <!-- Comments List -->
        <div class="space-y-6">
            @foreach($post->comments as $comment)
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500 shrink-0">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="flex items-baseline gap-2 mb-1">
                            <span class="font-bold text-gray-900">{{ $comment->user->name }}</span>
                            <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700">{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection