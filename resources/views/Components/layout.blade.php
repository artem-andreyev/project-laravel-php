<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LVCareer - Find Your Dream Job</title>
    @vite(['resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">

<nav class="bg-gray-900 shadow-lg">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="/" class="flex items-center gap-2">
                    <span class="text-blue-400 font-extrabold text-xl tracking-tight">LV<span class="text-white">Career</span></span>
                </a>
                <div class="hidden md:flex items-center space-x-1">
                    <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                    <x-nav-link href="/jobs" :active="request()->is('jobs') || request()->is('jobs/*')">Jobs</x-nav-link>
                    <x-nav-link href="/internships" :active="request()->is('internships') || request()->is('internships/*')">Internships</x-nav-link>
                    <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-3">
                @guest
                    <a href="/login" class="text-gray-300 hover:text-white text-sm font-medium px-3 py-2 rounded-md hover:bg-gray-700 transition">Log In</a>
                    <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-md transition">Register</a>
                @endguest
                @auth
                    <div class="flex items-center gap-3">
                        <a href="/profile" class="text-gray-300 hover:text-white text-sm font-medium px-3 py-2 rounded-md hover:bg-gray-700 transition">
                            {{ Auth::user()->first_name }}
                        </a>
                        <a href="/applications" class="text-gray-300 hover:text-white text-sm font-medium px-3 py-2 rounded-md hover:bg-gray-700 transition">My Applications</a>
                        @if(Auth::user()->isAdmin())
                            <a href="/admin" class="text-yellow-400 hover:text-yellow-300 text-sm font-medium px-3 py-2 rounded-md hover:bg-gray-700 transition">Admin</a>
                        @endif
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-white text-sm font-medium px-3 py-2 rounded-md hover:bg-gray-700 transition">Log Out</button>
                        </form>
                    </div>
                @endauth
            </div>
            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button id="mobile-btn" type="button" class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white">
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-gray-800 border-t border-gray-700">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href="/jobs" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Jobs</a>
            <a href="/internships" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Internships</a>
            <a href="/contact" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
            @guest
                <a href="/login" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Log In</a>
                <a href="/register" class="block text-blue-400 hover:text-blue-300 px-3 py-2 rounded-md text-sm font-medium">Register</a>
            @endguest
            @auth
                <a href="/profile" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">My Profile</a>
                <a href="/applications" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">My Applications</a>
                @if(Auth::user()->isAdmin())
                    <a href="/admin" class="block text-yellow-400 px-3 py-2 rounded-md text-sm font-medium">Admin Panel</a>
                @endif
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="block w-full text-left text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Log Out</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
        <div class="flex gap-3">
            @auth
                @if(request()->is('jobs') || request()->is('jobs/'))
                    <a href="/jobs/create" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-md transition">+ Post Job</a>
                @endif
                @if(request()->is('internships') || request()->is('internships/'))
                    <a href="/internships/create" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-md transition">+ Post Internship</a>
                @endif
            @endauth
        </div>
    </div>
</header>

@if(session('success'))
    <div class="mx-auto max-w-7xl mt-4 px-4 sm:px-6 lg:px-8">
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
            <p class="text-green-700 font-medium">{{ session('success') }}</p>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="mx-auto max-w-7xl mt-4 px-4 sm:px-6 lg:px-8">
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
            <p class="text-red-700 font-medium">{{ session('error') }}</p>
        </div>
    </div>
@endif

<main class="flex-grow">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
</main>

<footer class="bg-gray-900 text-gray-400 mt-auto">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <span class="text-blue-400 font-extrabold text-lg">LV<span class="text-white">Career</span></span>
                <p class="mt-2 text-sm">Latvia's platform for jobs, internships and professional networking.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Quick Links</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="/jobs" class="hover:text-white transition">Browse Jobs</a></li>
                    <li><a href="/internships" class="hover:text-white transition">Internships</a></li>
                    <li><a href="/contact" class="hover:text-white transition">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Contact</h4>
                <ul class="space-y-1 text-sm">
                    <li>support@lvcareer.lv</li>
                    <li>+371 20 000 000</li>
                    <li>Riga, Latvia</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm">
            &copy; {{ date('Y') }} LVCareer. All rights reserved.
        </div>
    </div>
</footer>

<script>
    document.getElementById('mobile-btn').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
</body>
</html>
