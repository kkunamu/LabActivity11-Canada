@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Create New Post</h1>
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <strong class="block mb-1">Please fix the following errors:</strong>
                <ul class="ml-4 list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            
            <div class="mb-5">
                <label class="block font-bold text-gray-700 mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 focus:outline-none focus:border-[#990000]">
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block font-bold text-gray-700 mb-2">Body</label>
                <textarea name="body" rows="6" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 focus:outline-none focus:border-[#990000]">{{ old('body') }}</textarea>
                @error('body') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block font-bold text-gray-700 mb-2">Category</label>
                <select name="category" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 focus:outline-none focus:border-[#990000]">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @error('category') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5 border-t border-gray-100 pt-5">
                <label class="block font-bold text-gray-700 mb-3">Tags (Select at least one)</label>
                <div class="flex flex-wrap gap-4">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="text-[#990000] focus:ring-[#990000]" @checked(is_array(old('tags')) && in_array($tag->id, old('tags')))>
                            <span class="ml-2 text-gray-700">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('tags') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                @error('tags.*') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-8 border-t border-gray-100 pt-5">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_published" value="1" class="w-5 h-5 text-[#990000] focus:ring-[#990000]" @checked(old('is_published'))>
                    <span class="ml-2 font-bold text-gray-700">Publish immediately</span>
                </label>
            </div>

            <button type="submit" class="bg-[#990000] text-white font-bold px-8 py-3 rounded-lg hover:bg-red-800 transition-colors w-full sm:w-auto">Save Post</button>
        </form>
    </div>
</div>
@endsection