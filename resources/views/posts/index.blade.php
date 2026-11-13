@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-3xl font-bold mb-6 text-gray-900">Barangay Bulletin - Purok Cañada</h1>

    <!-- Sleek Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-8">
        <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-4 items-center">
            <div class="flex-1 w-full relative">
                <input name="q" value="{{ request('q') }}" placeholder="Search announcements..." class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#990000]/20 focus:border-[#990000] transition-all">
            </div>
            
            <select name="category" class="w-full sm:w-48 bg-gray-50 border border-gray-200 text-gray-700 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#990000]/20 focus:border-[#990000] transition-all">
                <option value="">All Categories</option>
                @foreach ($categories as $c)
                    <option value="{{ $c }}" {{ request('category') == $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
            
            <div class="flex gap-2 w-full sm:w-auto">
                <button class="flex-1 sm:flex-none bg-[#990000] text-white font-medium px-6 py-2.5 rounded-lg shadow-sm hover:bg-[#7a0000] transition-colors">Filter</button>
                @if(request('q') || request('category'))
                    <a href="{{ route('posts.index') }}" class="flex items-center justify-center px-4 py-2.5 text-gray-500 hover:text-[#990000] hover:bg-red-50 rounded-lg transition-colors">Clear</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Modern Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        @forelse ($posts as $post)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 p-6 relative flex flex-col">
                @if($post->is_pinned)
                    <span class="absolute top-5 right-5 bg-[#990000] text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wide shadow-sm">Pinned</span>
                @endif
                
                <div class="mb-4">
                    <span class="inline-block bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-1 rounded-md">{{ $post->category }}</span>
                </div>
                
                <h2 class="text-xl font-bold mb-3 pr-16 leading-tight">
                    <a href="{{ route('posts.show', $post->id) }}" class="text-gray-800 hover:text-[#990000] transition-colors">{{ $post->title }}</a>
                </h2>
                
                <div class="mt-auto pt-4 border-t border-gray-50 text-sm text-gray-400 flex justify-between items-center">
                    <span class="font-medium text-gray-500">{{ $post->published_at->format('M d, Y') }}</span>
                    <span class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-md text-xs font-medium">👁 {{ $post->views }}</span>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-white rounded-xl border border-gray-100 border-dashed">
                <p class="text-gray-500 font-medium text-lg">No posts match your search.</p>
                <a href="{{ route('posts.index') }}" class="text-[#990000] hover:underline text-sm mt-2 inline-block">Clear filters</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mb-2">
        {{ $posts->links() }}
    </div>
    
    @if($posts->total() > 0)
        <p class="text-sm text-gray-500 font-medium text-center mt-6">Showing {{ $posts->firstItem() }}-{{ $posts->lastItem() }} of {{ $posts->total() }} posts</p>
    @endif
</div>
@endsection