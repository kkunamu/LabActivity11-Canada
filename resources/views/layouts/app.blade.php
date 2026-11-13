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
            <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <a href="/posts" class="text-2xl font-bold tracking-wide text-[#990000] hover:text-red-700 transition-colors">Barangay Bulletin</a>
                <p class="text-sm text-gray-500 font-medium">Barangay Matina Crossing Health Center</p>
            </div>
        </nav>

        <main class="flex-1 w-full max-w-6xl mx-auto px-4 py-8">
            @yield('content')
        </main>

        <footer class="bg-white text-gray-500 text-center text-sm py-6 border-t border-gray-200 mt-auto shadow-inner">
            &copy; 2026 Barangay Matina Crossing Health Center &middot; Davao City
        </footer>
    </body> 
</html>