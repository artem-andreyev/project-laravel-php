<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="lg:col-span-1 space-y-4">
            <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-2xl font-bold">{{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}</span>
                </div>
                <h2 class="text-xl font-bold text-gray-900">{{ $user->full_name }}</h2>
                <p class="text-gray-500 text-sm mt-1">{{ $user->email }}</p>
                <span class="inline-block mt-2 text-xs font-semibold px-3 py-1 rounded-full
                    @if($user->role === 'admin') bg-yellow-100 text-yellow-800
                    @elseif($user->role === 'employer') bg-green-100 text-green-800
                    @else bg-blue-100 text-blue-800 @endif">
                    {{ ucfirst($user->role) }}
                </span>
                @if($profile->location)
                    <p class="text-gray-500 text-sm mt-2">{{ $profile->location }}</p>
                @endif
                <div class="mt-4">
                    <a href="/profile/edit" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg text-sm transition">Edit Profile</a>
                </div>
            </div>

            @if($profile->cv_path)
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <h4 class="font-semibold text-gray-900 mb-3">CV / Resume</h4>
                    <a
                        href="{{ Storage::url($profile->cv_path) }}"
                        target="_blank"
                        class="flex items-center gap-2 text-blue-600 hover:text-blue-800 text-sm font-medium"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download CV
                    </a>
                </div>
            @endif
        </div>

        <!-- Main Profile Content -->
        <div class="lg:col-span-2 space-y-5">
            @if($profile->bio)
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-900 mb-3">About Me</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $profile->bio }}</p>
                </div>
            @endif

            @if($profile->skills)
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-900 mb-3">Skills</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($profile->skills_array as $skill)
                            <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full border border-blue-100">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($profile->education)
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-900 mb-3">Education</h3>
                    <p class="text-gray-700 text-sm">{{ $profile->education }}</p>
                </div>
            @endif

            @if($profile->website)
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <h4 class="font-semibold text-gray-900 mb-2">Website</h4>
                    <a href="{{ $profile->website }}" target="_blank" class="text-blue-600 hover:underline text-sm">{{ $profile->website }}</a>
                </div>
            @endif

            <!-- Recent Applications -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-gray-900">Recent Applications</h3>
                    <a href="/applications" class="text-blue-600 hover:underline text-sm">View all</a>
                </div>
                @if($applications->isEmpty())
                    <p class="text-gray-500 text-sm">You have not applied to any positions yet.</p>
                    <div class="mt-3 flex gap-3">
                        <a href="/jobs" class="text-sm text-blue-600 hover:underline">Browse Jobs</a>
                        <a href="/internships" class="text-sm text-blue-600 hover:underline">Browse Internships</a>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($applications as $application)
                            @php $listing = $application->getListing(); @endphp
                            @if($listing)
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $listing->title }}</p>
                                        <p class="text-xs text-gray-500 capitalize">{{ $application->listing_type }} &bull; {{ $application->applied_at->format('M d, Y') }}</p>
                                    </div>
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full
                                        @if($application->status === 'accepted') bg-green-100 text-green-800
                                        @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                        @elseif($application->status === 'reviewed') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-600 @endif">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
