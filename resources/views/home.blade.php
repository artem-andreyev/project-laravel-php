<x-layout>
    <x-slot:heading>Home</x-slot:heading>

    <!-- Hero -->
    <section class="relative -mx-4 sm:-mx-6 lg:-mx-8 -mt-8 px-4 sm:px-6 lg:px-8 pt-20 pb-24 text-center overflow-hidden bg-gradient-to-br from-blue-600 via-blue-500 to-indigo-600">
        <div class="absolute inset-0 opacity-10" style="background-image:url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fff' fill-opacity='1' fill-rule='evenodd'%3E%3Ccircle cx='7' cy='7' r='1'/%3E%3Ccircle cx='27' cy='7' r='1'/%3E%3Ccircle cx='47' cy='7' r='1'/%3E%3Ccircle cx='7' cy='27' r='1'/%3E%3Ccircle cx='27' cy='27' r='1'/%3E%3Ccircle cx='47' cy='27' r='1'/%3E%3Ccircle cx='7' cy='47' r='1'/%3E%3Ccircle cx='27' cy='47' r='1'/%3E%3Ccircle cx='47' cy='47' r='1'/%3E%3C/g%3E%3C/svg%3E\");"></div>

        <div class="relative max-w-3xl mx-auto">
            <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-6 backdrop-blur-sm border border-white/30">
                🇱🇻 Latvia's #1 Career Platform
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight mb-5">
                Find Your Dream<br><span class="text-blue-100">Job or Internship</span>
            </h1>
            <p class="text-blue-100 text-lg mb-10 max-w-xl mx-auto">
                Thousands of opportunities across Latvia — from entry-level to senior roles.
            </p>

            <!-- Search tabs -->
            <div class="bg-white rounded-2xl shadow-2xl p-2 max-w-2xl mx-auto">
                <div class="flex gap-1 mb-2">
                    <button onclick="switchTab('jobs')" id="tab-jobs"
                        class="flex-1 py-2 text-sm font-semibold rounded-xl transition tab-btn bg-blue-600 text-white">
                        Jobs
                    </button>
                    <button onclick="switchTab('internships')" id="tab-internships"
                        class="flex-1 py-2 text-sm font-semibold rounded-xl transition tab-btn text-gray-500 hover:text-gray-900">
                        Internships
                    </button>
                </div>
                <form id="form-jobs" action="/jobs" method="GET" class="flex gap-2">
                    <input type="text" name="search" placeholder="e.g. PHP Developer, Riga..."
                        class="flex-1 px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-sm">
                        Search
                    </button>
                </form>
                <form id="form-internships" action="/internships" method="GET" class="hidden flex gap-2">
                    <input type="text" name="search" placeholder="e.g. Marketing, IT internship..."
                        class="flex-1 px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-sm">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Stats bar -->
    <div class="bg-white border-b border-gray-200 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto grid grid-cols-3 divide-x divide-gray-100 py-5">
            <div class="text-center">
                <p class="text-2xl font-extrabold text-blue-600">500+</p>
                <p class="text-xs text-gray-500 mt-0.5">Active Jobs</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-extrabold text-blue-600">120+</p>
                <p class="text-xs text-gray-500 mt-0.5">Internships</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-extrabold text-blue-600">200+</p>
                <p class="text-xs text-gray-500 mt-0.5">Companies</p>
            </div>
        </div>
    </div>

    <!-- Cards -->
    <section class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="/jobs" class="group relative bg-white rounded-2xl border border-blue-100 shadow-sm hover:shadow-lg transition-all p-8 overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-blue-50 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:bg-blue-100 transition-colors"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-5 shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Browse Jobs</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">Explore full-time and part-time positions across all industries in Latvia.</p>
                <span class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 group-hover:gap-2 transition-all">
                    View all jobs
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
                <h3 class="text-xl font-bold text-gray-900 mb-2">Internships</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">Launch your career with hands-on internships at leading Latvian companies.</p>
                <span class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 group-hover:gap-2 transition-all">
                    View all internships
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>
    </section>

    <!-- Why us -->
    <section class="mt-12 bg-white rounded-2xl border border-blue-100 shadow-sm p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">Why LVCareer?</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h4 class="font-semibold text-gray-900 text-sm mb-1">Fast Applications</h4>
                <p class="text-xs text-gray-500">Apply in seconds with your saved profile.</p>
            </div>
            <div class="text-center">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h4 class="font-semibold text-gray-900 text-sm mb-1">Verified Employers</h4>
                <p class="text-xs text-gray-500">All companies are reviewed and verified.</p>
            </div>
            <div class="text-center">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </div>
                <h4 class="font-semibold text-gray-900 text-sm mb-1">Instant Alerts</h4>
                <p class="text-xs text-gray-500">Get notified when matching jobs appear.</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    @guest
    <section class="mt-8 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-center text-white">
        <h2 class="text-2xl font-bold mb-2">Ready to get started?</h2>
        <p class="text-blue-100 text-sm mb-6">Create a free account and apply to jobs in minutes.</p>
        <div class="flex items-center justify-center gap-3">
            <a href="/register" class="bg-white text-blue-700 font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-blue-50 transition shadow-sm">Create Account</a>
            <a href="/jobs" class="border border-white/40 text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-white/10 transition">Browse Jobs</a>
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
