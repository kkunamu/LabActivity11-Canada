<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Barangay Bulletin - Purok Cañada')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-slate-50 text-gray-800 font-sans">
        <!-- Clean Header with AO3 Red Accent Border -->
        <nav class="bg-white border-t-4 border-[#990000] shadow-sm">
            <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <a href="/posts" class="text-2xl font-bold tracking-wide text-[#990000] hover:text-red-700 transition-colors">Barangay Bulletin</a>
                    <p class="text-sm text-gray-500 font-medium">Barangay Matina Crossing Health Center</p>
                </div>
                
                <div class="flex items-center gap-4 text-sm font-medium">
                    @auth
                        <span class="text-gray-600">Logged in as: <strong class="text-[#990000]">{{ auth()->user()->name }}</strong></span>
                        @if(auth()->user()->author)
                            <a href="{{ route('posts.create') }}" class="bg-[#990000] text-white px-3 py-1.5 rounded hover:bg-red-800 transition-colors">New Post</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-gray-800 underline">Logout</button>
                        </form>
                    @endauth
                    
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#990000] underline">Sign In</a>
                    @endguest
                </div>
            </div>
        </nav>
        
        <!-- Add Flash Message Display right below the nav -->
        @if (session('status'))
            <div class="max-w-6xl mx-auto mt-4 px-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            </div>
        @endif

        <main class="flex-1 w-full max-w-6xl mx-auto px-4 py-8">
            @yield('content')
        </main>

        <footer class="bg-white text-gray-500 text-center text-sm py-6 border-t border-gray-200 mt-auto shadow-inner">
            &copy; 2026 Barangay Matina Crossing Health Center &middot; Davao City
        </footer>
    </body> 
</html>