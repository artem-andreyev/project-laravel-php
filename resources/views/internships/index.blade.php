<x-layout>
    <x-slot:heading>Internship Listings</x-slot:heading>

    <!-- Filter Bar -->
    <form method="GET" action="/internships" class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by title..."
                class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
            >
            <select name="duration" class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="">Any Duration</option>
                <option value="1" {{ request('duration') == '1' ? 'selected' : '' }}>1 month</option>
                <option value="2" {{ request('duration') == '2' ? 'selected' : '' }}>2 months</option>
                <option value="3" {{ request('duration') == '3' ? 'selected' : '' }}>3 months</option>
                <option value="6" {{ request('duration') == '6' ? 'selected' : '' }}>6 months</option>
                <option value="12" {{ request('duration') == '12' ? 'selected' : '' }}>12 months</option>
            </select>
            <input
                type="text"
                name="location"
                value="{{ request('location') }}"
                placeholder="Location (e.g. Riga)..."
                class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
            >
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg text-sm transition">Search</button>
                <a href="/internships" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2.5 px-4 rounded-lg text-sm transition text-center">Reset</a>
            </div>
        </div>
    </form>

    @if($internships->isEmpty())
        <div class="text-center py-16 bg-white rounded-xl border border-gray-200">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v7m0-7L3 9"/>
            </svg>
            <p class="mt-4 text-gray-500 text-lg">No internships found matching your criteria.</p>
            <a href="/internships" class="mt-4 inline-block text-blue-600 hover:underline">Clear filters</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($internships as $internship)
                <a href="/internships/{{ $internship->id }}" class="block bg-white rounded-xl border border-gray-200 p-5 hover:border-blue-300 hover:shadow-md transition group">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">{{ $internship->employer->name }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition">{{ $internship->title }}</h3>
                            @if($internship->description)
                                <p class="text-gray-600 text-sm mt-1">{{ Str::limit($internship->description, 120) }}</p>
                            @endif
                            <div class="flex flex-wrap items-center gap-4 mt-3 text-sm text-gray-500">
                                @if($internship->location)
                                    <span>{{ $internship->location }}</span>
                                @endif
                                <span>{{ $internship->duration }} {{ $internship->duration == 1 ? 'month' : 'months' }}</span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 ml-4 whitespace-nowrap">{{ $internship->created_at->diffForHumans() }}</span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-6">{{ $internships->withQueryString()->links() }}</div>
    @endif
</x-layout>
