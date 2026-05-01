<x-layout>
    <x-slot:heading>My Applications</x-slot:heading>

    @if($applications->isEmpty())
        <div class="text-center py-16 bg-white rounded-xl border border-gray-200">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="mt-4 text-gray-500 text-lg">No applications yet.</p>
            <p class="text-gray-400 text-sm mt-1">Start applying for jobs and internships to see them here.</p>
            <div class="mt-5 flex justify-center gap-4">
                <a href="/jobs" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">Browse Jobs</a>
                <a href="/internships" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-5 py-2.5 rounded-lg transition">Browse Internships</a>
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $application)
                @php $listing = $application->getListing(); @endphp
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            @if($listing)
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $application->listing_type === 'job' ? 'bg-blue-50 text-blue-700' : 'bg-purple-50 text-purple-700' }}">
                                        {{ ucfirst($application->listing_type) }}
                                    </span>
                                    @if(isset($listing->employer))
                                        <span class="text-xs text-gray-500">{{ $listing->employer->name }}</span>
                                    @endif
                                </div>
                                <h3 class="text-base font-bold text-gray-900">{{ $listing->title }}</h3>
                                @if($application->listing_type === 'job')
                                    <p class="text-sm text-gray-500 mt-0.5">{{ $listing->salary }}</p>
                                @else
                                    <p class="text-sm text-gray-500 mt-0.5">{{ $listing->duration }} months</p>
                                @endif
                            @else
                                <p class="text-base font-bold text-gray-400 italic">Listing no longer available</p>
                            @endif

                            <p class="text-xs text-gray-400 mt-2">Applied {{ $application->applied_at->format('M d, Y') }}</p>

                            @if($application->cover_letter)
                                <details class="mt-3">
                                    <summary class="text-xs text-blue-600 cursor-pointer hover:text-blue-800">View cover letter</summary>
                                    <div class="mt-2 p-3 bg-gray-50 rounded-lg text-sm text-gray-700 leading-relaxed">{{ $application->cover_letter }}</div>
                                </details>
                            @endif
                        </div>

                        <div class="ml-4 flex flex-col items-end gap-3">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                @if($application->status === 'accepted') bg-green-100 text-green-800
                                @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                @elseif($application->status === 'reviewed') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-600 @endif">
                                {{ ucfirst($application->status) }}
                            </span>

                            @if($listing)
                                <a
                                    href="{{ $application->listing_type === 'job' ? '/jobs/' . $listing->id : '/internships/' . $listing->id }}"
                                    class="text-xs text-gray-400 hover:text-blue-600 transition"
                                >
                                    View listing
                                </a>
                            @endif

                            @if($application->status === 'pending')
                                <form method="POST" action="/applications/{{ $application->id }}" onsubmit="return confirm('Withdraw this application?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs text-red-500 hover:text-red-700 transition">Withdraw</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layout>
