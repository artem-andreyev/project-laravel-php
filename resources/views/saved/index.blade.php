<x-layout>
    <x-slot:heading>Saved Jobs</x-slot:heading>

    <div class="max-w-4xl mx-auto">
        @if($saved->isEmpty())
            <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-16 text-center">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                </div>
                <p class="text-gray-700 font-semibold mb-1">No saved listings yet</p>
                <p class="text-gray-400 text-sm mb-6">Bookmark jobs and internships to find them here later.</p>
                <div class="flex items-center justify-center gap-3">
                    <a href="/jobs" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">Browse Jobs</a>
                    <a href="/internships" class="bg-white hover:bg-gray-50 text-gray-700 text-sm font-semibold px-5 py-2.5 rounded-xl border border-gray-200 transition">Internships</a>
                </div>
            </div>
        @else
            <div class="space-y-3">
                @foreach($saved as $item)
                    @php $listing = $item->getListing(); @endphp
                    @if($listing)
                    <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-5 flex items-center justify-between gap-4 hover:shadow-md transition group">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0
                                {{ $item->listing_type === 'internship' ? 'bg-indigo-50' : 'bg-blue-50' }}">
                                @if($item->listing_type === 'internship')
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                @else
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <a href="/{{ $item->listing_type === 'internship' ? 'internships' : 'jobs' }}/{{ $listing->id }}"
                                   class="text-sm font-bold text-gray-900 group-hover:text-blue-700 transition truncate block">
                                    {{ $listing->title }}
                                </a>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs font-semibold px-2 py-0.5 rounded-lg capitalize
                                        {{ $item->listing_type === 'internship' ? 'bg-indigo-50 text-indigo-600' : 'bg-blue-50 text-blue-600' }}">
                                        {{ $item->listing_type }}
                                    </span>
                                    @if($listing->location)
                                        <span class="text-xs text-gray-400">{{ $listing->location }}</span>
                                    @endif
                                    <span class="text-xs text-gray-300">Saved {{ $item->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="/{{ $item->listing_type === 'internship' ? 'internships' : 'jobs' }}/{{ $listing->id }}"
                               class="text-sm font-semibold text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition">
                                View
                            </a>
                            <form method="POST" action="/saved/toggle">
                                @csrf
                                <input type="hidden" name="listing_type" value="{{ $item->listing_type }}">
                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                <button class="text-sm font-semibold text-red-400 hover:text-red-600 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
