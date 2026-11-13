@extends('layouts.app')

@section('title', 'Sign in')

@section('content')
<form method="POST" action="/login" class="max-w-sm mx-auto mt-10 space-y-4 p-6 bg-white rounded-lg shadow">
    @csrf
    <h1 class="text-xl font-semibold text-emerald-700">Health Worker Sign in</h1>

    <div>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
               class="w-full border rounded p-2">
        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <input type="password" name="password" placeholder="Password" class="w-full border rounded p-2">
        @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white rounded p-2">Sign in</button>
</form>
@endsection