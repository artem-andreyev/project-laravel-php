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
                <div class="relative bg-white rounded-xl border border-gray-200 hover:border-blue-300 hover:shadow-md transition group">
                    <a href="/internships/{{ $internship->id }}" class="block p-5">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 pr-10">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">{{ $internship->employer->name ?? 'Company' }}</span>
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
                            <span class="text-xs text-gray-400 whitespace-nowrap mt-10">{{ $internship->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                    @auth
                        @php $saved = auth()->user()->hasSaved('internship', $internship->id); @endphp
                        <form method="POST" action="/saved/toggle" class="absolute top-4 right-4">
                            @csrf
                            <input type="hidden" name="listing_type" value="internship">
                            <input type="hidden" name="listing_id" value="{{ $internship->id }}">
                            <button type="submit" title="{{ $saved ? 'Remove from saved' : 'Save internship' }}"
                                class="w-8 h-8 flex items-center justify-center rounded-lg transition {{ $saved ? 'text-blue-600 bg-blue-50 hover:bg-blue-100' : 'text-gray-400 hover:text-blue-600 hover:bg-blue-50' }}">
                                <svg class="w-4 h-4" fill="{{ $saved ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            </button>
                        </form>
                    @endauth
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $internships->withQueryString()->links() }}</div>
    @endif
</x-layout>
