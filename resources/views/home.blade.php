<x-layout>
    <x-slot:heading>{{ __('home.heading') }}</x-slot:heading>

    <!-- Hero -->
    <section class="relative rounded-2xl px-6 pt-16 pb-20 text-center overflow-hidden bg-gradient-to-br from-blue-600 via-blue-500 to-indigo-600">
        <!-- Decorative blobs -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-400/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-blue-300/10 rounded-full blur-2xl"></div>

        <div class="relative max-w-3xl mx-auto">
            <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-6 backdrop-blur-sm border border-white/30">
                {{ __('home.badge') }}
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight mb-5">
                {{ __('home.hero.title') }}<br><span class="text-blue-100">{{ __('home.hero.titleHighlight') }}</span>
            </h1>
            <p class="text-blue-100 text-lg mb-10 max-w-xl mx-auto">
                {{ __('home.hero.subtitle') }}
            </p>

            <!-- Search tabs -->
            <div class="bg-white rounded-2xl shadow-2xl p-2 max-w-2xl mx-auto">
                <div class="flex gap-1 mb-2">
                    <button onclick="switchTab('jobs')" id="tab-jobs"
                        class="flex-1 py-2 text-sm font-semibold rounded-xl transition tab-btn bg-blue-600 text-white">
                        {{ __('home.search.jobsTab') }}
                    </button>
                    <button onclick="switchTab('internships')" id="tab-internships"
                        class="flex-1 py-2 text-sm font-semibold rounded-xl transition tab-btn text-gray-500 hover:text-gray-900">
                        {{ __('home.search.internshipsTab') }}
                    </button>
                </div>
                <form id="form-jobs" action="/jobs" method="GET" class="flex gap-2">
                    <input type="text" name="search" placeholder="{{ __('home.search.jobPlaceholder') }}"
                        class="flex-1 px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-sm">
                        {{ __('home.search.button') }}
                    </button>
                </form>
                <form id="form-internships" action="/internships" method="GET" class="hidden flex gap-2">
                    <input type="text" name="search" placeholder="{{ __('home.search.internshipPlaceholder') }}"
                        class="flex-1 px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-sm">
                        {{ __('home.search.button') }}
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Stats bar -->
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm mt-6">
        <div class="grid grid-cols-3 divide-x divide-gray-100 py-5">
            <div class="text-center">
                <p class="text-2xl font-extrabold text-blue-600">{{ $stats['jobs'] }}</p>
                <p class="text-xs text-gray-500 mt-0.5">{{ __('home.stats.listings') }}</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-extrabold text-blue-600">{{ $stats['internships'] }}</p>
                <p class="text-xs text-gray-500 mt-0.5">{{ __('nav.internships') }}</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-extrabold text-blue-600">{{ $stats['employers'] }}</p>
                <p class="text-xs text-gray-500 mt-0.5">{{ __('home.stats.companies') }}</p>
            </div>
        </div>
    </div>

    <!-- Latest Jobs -->
    @if($latestJobs->count())
    <section class="mt-10">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-gray-900">{{ __('jobs.heading') }}</h2>
            <a href="/jobs" class="text-sm font-semibold text-blue-600 hover:underline">{{ __('buttons.view') }} →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($latestJobs as $job)
            <a href="/jobs/{{ $job->id }}" class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition-all p-5 flex flex-col">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-xs bg-blue-50 text-blue-700 font-semibold px-2 py-1 rounded-lg">{{ ucfirst(str_replace('-', ' ', $job->job_type ?? 'Full-time')) }}</span>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-1 group-hover:text-blue-600 transition-colors">{{ $job->title }}</h3>
                <p class="text-xs text-gray-500 mb-3">{{ $job->employer->name ?? 'Company' }}</p>
                <div class="mt-auto flex items-center gap-3 text-xs text-gray-400">
                    @if($job->location)
                    <span class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $job->location }}
                    </span>
                    @endif
                    @if($job->salary)
                    <span class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $job->salary }}
                    </span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Cards -->
    <section class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="/jobs" class="group relative bg-white rounded-2xl border border-blue-100 shadow-sm hover:shadow-lg transition-all p-8 overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-blue-50 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:bg-blue-100 transition-colors"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-5 shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('nav.jobs') }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ __('jobs.search') }}</p>
                <span class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 group-hover:gap-2 transition-all">
                    {{ __('buttons.view') }} {{__('nav.jobs')}}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>

        <a href="/internships" class="group relative bg-white rounded-2xl border border-blue-100 shadow-sm hover:shadow-lg transition-all p-8 overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-50 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:bg-indigo-100 transition-colors"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center mb-5 shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('nav.internships') }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ __('internships.search') }}</p>
                <span class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 group-hover:gap-2 transition-all">
                    {{ __('buttons.view') }} {{__('nav.internships')}}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>
    </section>

    <!-- Why us -->
    <section class="mt-12 bg-white rounded-2xl border border-blue-100 shadow-sm p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">{{ __('app.name') }} - {{ __('home.stats.title') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h4 class="font-semibold text-gray-900 text-sm mb-1">{{ __('home.stats.title') }}</h4>
                <p class="text-xs text-gray-500">{{ __('app.tagline') }}</p>
            </div>
            <div class="text-center">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h4 class="font-semibold text-gray-900 text-sm mb-1">{{ __('admin.manage') }}</h4>
                <p class="text-xs text-gray-500">{{ __('admin.users') }}</p>
            </div>
            <div class="text-center">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </div>
                <h4 class="font-semibold text-gray-900 text-sm mb-1">{{ __('messages.success') }}</h4>
                <p class="text-xs text-gray-500">{{ __('app.tagline') }}</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    @guest
    <section class="mt-8 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-center text-white">
        <h2 class="text-2xl font-bold mb-2">{{ __('home.hero.title') }}?</h2>
        <p class="text-blue-100 text-sm mb-6">{{ __('app.tagline') }}</p>
        <div class="flex items-center justify-center gap-3">
            <a href="/register" class="bg-white text-blue-700 font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-blue-50 transition shadow-sm">{{ __('nav.register') }}</a>
            <a href="/jobs" class="border border-white/40 text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-white/10 transition">{{ __('nav.jobs') }}</a>
        </div>
    </section>
    @endguest

    <script>
    function switchTab(tab) {
        document.getElementById('form-jobs').classList.toggle('hidden', tab !== 'jobs');
        document.getElementById('form-internships').classList.toggle('hidden', tab !== 'internships');
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('text-gray-500');
        });
        const active = document.getElementById('tab-' + tab);
        active.classList.add('bg-blue-600', 'text-white');
        active.classList.remove('text-gray-500');
    }
    </script>
</x-layout>
