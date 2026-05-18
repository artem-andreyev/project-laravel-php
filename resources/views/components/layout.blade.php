<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LVCareer - Find Your Dream Job</title>
    @vite(['resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-slate-50">

<!-- Navbar -->
<nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <!-- Logo + Nav links -->
            <div class="flex items-center gap-8">
                <a href="/" class="flex items-center gap-2 flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/></svg>
                    </div>
                    <span class="font-extrabold text-xl tracking-tight text-gray-900">LV<span class="text-blue-600">Career</span></span>
                </a>
                <div class="hidden md:flex items-center gap-1">
                    <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                    <x-nav-link href="/jobs" :active="request()->is('jobs') || request()->is('jobs/*')">Jobs</x-nav-link>
                    <x-nav-link href="/internships" :active="request()->is('internships') || request()->is('internships/*')">Internships</x-nav-link>
                    <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
                </div>
            </div>

            <!-- Right side -->
            <div class="hidden md:flex items-center gap-2">
                @guest
                    <a href="/login" class="text-gray-600 hover:text-gray-900 text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-100 transition">Log In</a>
                    <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-sm">Register</a>
                @endguest
                @auth
                    @php
                        $pendingBadge = 0;
                        if (Auth::user()->canPostListings() && Auth::user()->employer) {
                            $empId = Auth::user()->employer->id;
                            $jobIds = \App\Models\Job::where('employer_id', $empId)->pluck('id');
                            $internshipIds = \App\Models\Internship::where('employer_id', $empId)->pluck('id');
                            $pendingBadge = \App\Models\Application::where('status', 'pending')
                                ->where(function($q) use ($jobIds, $internshipIds) {
                                    $q->where(function($q2) use ($jobIds) {
                                        $q2->where('listing_type', 'job')->whereIn('listing_id', $jobIds);
                                    })->orWhere(function($q2) use ($internshipIds) {
                                        $q2->where('listing_type', 'internship')->whereIn('listing_id', $internshipIds);
                                    });
                                })->count();
                        }
                    @endphp
                    <div class="flex items-center gap-1">
                        @if(Auth::user()->isAdmin())
                            <a href="/admin" class="text-amber-600 hover:text-amber-700 text-sm font-semibold px-3 py-2 rounded-lg hover:bg-amber-50 transition">Admin</a>
                        @endif
                        @if(Auth::user()->canPostListings())
                            <a href="/employer/dashboard" class="relative text-gray-600 hover:text-gray-900 text-sm font-medium px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                Dashboard
                                @if($pendingBadge > 0)
                                    <span class="absolute -top-0.5 -right-0.5 min-w-[16px] h-4 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center px-0.5">{{ $pendingBadge > 9 ? '9+' : $pendingBadge }}</span>
                                @endif
                            </a>
                        @else
                            <a href="/saved" class="text-gray-600 hover:text-gray-900 text-sm font-medium px-3 py-2 rounded-lg hover:bg-gray-100 transition">Saved</a>
                            <a href="/applications" class="text-gray-600 hover:text-gray-900 text-sm font-medium px-3 py-2 rounded-lg hover:bg-gray-100 transition">Applications</a>
                        @endif
                        <a href="/profile" class="flex items-center gap-2 ml-1 px-3 py-2 rounded-lg hover:bg-blue-50 transition group">
                            <div class="w-7 h-7 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs font-bold">{{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-blue-700 transition">{{ Auth::user()->first_name }}</span>
                        </a>
                        <form method="POST" action="/logout" class="ml-1">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-red-600 text-sm font-medium px-3 py-2 rounded-lg hover:bg-red-50 transition">Log Out</button>
                        </form>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-1 flex md:hidden">
                <button id="mobile-btn" type="button" class="inline-flex items-center justify-center rounded-lg p-2 text-gray-500 hover:text-gray-900 hover:bg-gray-100 transition">
                    <svg class="block h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-3 space-y-1">
            <a href="/" class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition">Home</a>
            <a href="/jobs" class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition">Jobs</a>
            <a href="/internships" class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition">Internships</a>
            <a href="/contact" class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition">Contact</a>
            <div class="border-t border-gray-100 my-2"></div>
            @guest
                <a href="/login" class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition">Log In</a>
                <a href="/register" class="block text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-semibold transition">Register</a>
            @endguest
            @auth
                <a href="/profile" class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition">My Profile</a>
                <a href="/applications" class="block text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition">My Applications</a>
                @if(Auth::user()->isAdmin())
                    <a href="/admin" class="block text-amber-600 hover:bg-amber-50 px-3 py-2 rounded-lg text-sm font-semibold transition">Admin Panel</a>
                @endif
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="block w-full text-left text-red-500 hover:bg-red-50 px-3 py-2 rounded-lg text-sm font-medium transition">Log Out</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<!-- Page Header -->
<header class="bg-gradient-to-r from-blue-600 to-indigo-600 shadow-sm">
    <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-white tracking-tight">{{ $heading }}</h1>
        </div>
        <div class="flex gap-3">
            @auth
                @if(Auth::user()->canPostListings())
                    @if(request()->is('jobs') || request()->is('jobs/'))
                        <a href="/jobs/create" class="inline-flex items-center gap-1.5 bg-white/20 hover:bg-white/30 border border-white/40 text-white text-sm font-semibold px-4 py-2 rounded-lg transition backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Post Job
                        </a>
                    @endif
                    @if(request()->is('internships') || request()->is('internships/'))
                        <a href="/internships/create" class="inline-flex items-center gap-1.5 bg-white/20 hover:bg-white/30 border border-white/40 text-white text-sm font-semibold px-4 py-2 rounded-lg transition backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Post Internship
                        </a>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</header>

<!-- Flash Messages -->
@if(session('success'))
    <div class="mx-auto max-w-7xl mt-5 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl shadow-sm">
            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="font-medium text-sm">{{ session('success') }}</p>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="mx-auto max-w-7xl mt-5 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-sm">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="font-medium text-sm">{{ session('error') }}</p>
        </div>
    </div>
@endif

<!-- Main Content -->
<main class="flex-grow">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
</main>

<!-- Footer -->
<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-7 h-7 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/></svg>
                    </div>
                    <span class="font-extrabold text-lg text-gray-900">LV<span class="text-blue-600">Career</span></span>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed max-w-xs">Latvia's platform for jobs, internships and professional opportunities. Connect with top employers.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/jobs" class="text-gray-500 hover:text-blue-600 transition">Browse Jobs</a></li>
                    <li><a href="/internships" class="text-gray-500 hover:text-blue-600 transition">Internships</a></li>
                    <li><a href="/contact" class="text-gray-500 hover:text-blue-600 transition">Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Contact</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        support@lvcareer.lv
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        +371 20 000 000
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        Riga, Latvia
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-100 mt-8 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} LVCareer. All rights reserved.</p>
            <div class="flex items-center gap-1">
                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                <span class="text-xs text-gray-400">All systems operational</span>
            </div>
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
