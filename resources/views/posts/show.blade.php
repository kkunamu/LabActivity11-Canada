@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('posts.index') }}" class="inline-flex items-center text-gray-500 hover:text-[#990000] font-medium text-sm mb-6 transition-colors">
        &larr; Back to Bulletin
    </a>
    
    <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative mt-2">
        <!-- Card Header -->
        <div class="bg-gray-50/50 border-b border-gray-100 p-8 relative">
            @if($post->is_pinned)
                <span class="absolute top-8 right-8 bg-[#990000] text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">Pinned</span>
            @endif
            
            <div class="mb-4">
                <span class="inline-block bg-white border border-gray-200 text-gray-600 text-xs font-medium px-3 py-1.5 rounded-lg shadow-sm">{{ $post->category }}</span>
            </div>
            
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6 pr-16 leading-tight">{{ $post->title }}</h1>
            
            <div class="flex flex-wrap gap-3 text-sm">
                <span class="bg-white border border-gray-200 text-gray-600 px-3 py-1.5 rounded-lg shadow-sm">
                    <span class="text-gray-400 mr-1">Author:</span> #{{ $post->author_id }}
                </span>
                <span class="bg-white border border-gray-200 text-gray-600 px-3 py-1.5 rounded-lg shadow-sm">
                    <span class="text-gray-400 mr-1">Published:</span> {{ $post->published_at->format('M d, Y') }}
                </span>
                <span class="bg-white border border-gray-200 text-gray-600 px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-1">
                    👁 {{ $post->views }} views
                </span>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="p-8 text-gray-700 text-lg leading-relaxed whitespace-pre-wrap">
            {{ $post->body }}
        </div>
    </article>
</div>
@endsection