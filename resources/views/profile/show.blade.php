<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

    @php
        $filled = collect([
            $profile->bio, $profile->skills, $profile->education,
            $profile->location, $profile->phone, $profile->website,
        ])->filter()->count();
        $percent = round($filled / 6 * 100);
    @endphp

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- ── Hero Card ── --}}
        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden">

            {{-- Avatar + Info --}}
            <div class="px-6 sm:px-8 pt-6 pb-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">

                    <div class="flex items-end gap-5">
                        {{-- Avatar --}}
                        <div class="w-16 h-16 rounded-2xl shadow-md flex items-center justify-center flex-shrink-0
                                    bg-gradient-to-br from-blue-500 to-indigo-600">
                            <span class="text-white text-xl font-black tracking-wide select-none">
                                {{ strtoupper(substr($user->first_name,0,1)) }}{{ strtoupper(substr($user->last_name,0,1)) }}
                            </span>
                        </div>

                        {{-- Name block --}}
                        <div class="pb-1">
                            <h2 class="text-2xl font-extrabold text-gray-900 leading-tight">{{ $user->full_name }}</h2>

                            @if($profile->bio)
                                <p class="text-gray-500 text-sm mt-0.5 max-w-sm line-clamp-1">{{ $profile->bio }}</p>
                            @else
                                <p class="text-gray-400 text-sm mt-0.5 italic">No bio added yet</p>
                            @endif

                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full
                                    @if($user->role === 'admin') bg-amber-100 text-amber-700
                                    @elseif($user->role === 'employer') bg-emerald-100 text-emerald-700
                                    @else bg-blue-100 text-blue-700 @endif">
                                    @if($user->role === 'admin')
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    @endif
                                    {{ ucfirst($user->role) }}
                                </span>
                                @if($profile->location)
                                    <span class="flex items-center gap-1 text-xs text-gray-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $profile->location }}
                                    </span>
                                @endif
                                <span class="flex items-center gap-1 text-xs text-gray-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    {{ $user->email }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="self-start sm:self-auto flex items-center gap-2 flex-wrap">
                        <a href="/cv/generate"
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            AI CV
                        </a>
                        <a href="/profile/edit"
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit Profile
                        </a>
                    </div>
                </div>

                {{-- Contact pills + CV --}}
                <div class="flex flex-wrap items-center gap-3 pt-4 border-t border-gray-100">
                    @if($profile->phone)
                        <a href="tel:{{ $profile->phone }}"
                           class="flex items-center gap-1.5 text-xs font-medium text-gray-600 hover:text-blue-600 bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 px-3 py-1.5 rounded-lg transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $profile->phone }}
                        </a>
                    @endif
                    @if($profile->website)
                        <a href="{{ $profile->website }}" target="_blank"
                           class="flex items-center gap-1.5 text-xs font-medium text-gray-600 hover:text-blue-600 bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-blue-200 px-3 py-1.5 rounded-lg transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            {{ $profile->website }}
                        </a>
                    @endif
                    @if($profile->cv_path)
                        <a href="{{ Storage::url($profile->cv_path) }}" target="_blank"
                           class="flex items-center gap-1.5 text-xs font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 px-3 py-1.5 rounded-lg transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download CV
                        </a>
                    @endif
                    @if(!$profile->phone && !$profile->website && !$profile->cv_path)
                        <p class="text-xs text-gray-400 italic">No contact details — <a href="/profile/edit" class="text-blue-500 hover:underline">add them</a></p>
                    @endif
                </div>
            </div>
        </div>

        {{-- ── Profile Completeness ── --}}
        @if($percent < 100)
        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm px-6 py-4 flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="flex-1">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-sm font-semibold text-gray-700">Profile completeness</span>
                    <span class="text-sm font-bold text-blue-600">{{ $percent }}%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2 rounded-full transition-all"
                         style="width: {{ $percent }}%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-1.5">Complete your profile to stand out to employers.</p>
            </div>
            <a href="/profile/edit"
               class="flex-shrink-0 text-sm font-semibold text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl transition">
                Complete profile →
            </a>
        </div>
        @endif

        {{-- ── Main Grid ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left column --}}
            <div class="space-y-5">

                {{-- About --}}
                <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-5">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">About Me</h3>
                    @if($profile->bio)
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $profile->bio }}</p>
                    @else
                        <div class="text-center py-4">
                            <p class="text-gray-400 text-sm">No bio added yet.</p>
                            <a href="/profile/edit" class="text-xs text-blue-500 hover:underline mt-1 inline-block">+ Add bio</a>
                        </div>
                    @endif
                </div>

                {{-- Skills --}}
                <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-5">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Skills</h3>
                    @if($profile->skills)
                        <div class="flex flex-wrap gap-2">
                            @foreach($profile->skills_array as $skill)
                                <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1.5 rounded-lg border border-blue-100">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-gray-400 text-sm">No skills listed.</p>
                            <a href="/profile/edit" class="text-xs text-blue-500 hover:underline mt-1 inline-block">+ Add skills</a>
                        </div>
                    @endif
                </div>

                {{-- Education --}}
                <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-5">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Education</h3>
                    @if($profile->education)
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                            </div>
                            <p class="text-gray-700 text-sm leading-relaxed">{{ $profile->education }}</p>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-gray-400 text-sm">No education listed.</p>
                            <a href="/profile/edit" class="text-xs text-blue-500 hover:underline mt-1 inline-block">+ Add education</a>
                        </div>
                    @endif
                </div>

            </div>

            {{-- Right column --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Applications --}}
                <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Recent Applications</h3>
                        <a href="/applications" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition">View all →</a>
                    </div>

                    @if($applications->isEmpty())
                        <div class="flex flex-col items-center justify-center py-14 px-6 text-center">
                            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="text-gray-700 font-semibold mb-1">No applications yet</p>
                            <p class="text-gray-400 text-sm mb-5">Start exploring opportunities and apply today.</p>
                            <div class="flex gap-3">
                                <a href="/jobs" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition shadow-sm">Browse Jobs</a>
                                <a href="/internships" class="bg-white hover:bg-gray-50 text-gray-700 text-sm font-semibold px-5 py-2 rounded-xl border border-gray-200 transition">Internships</a>
                            </div>
                        </div>
                    @else
                        <div class="divide-y divide-gray-50">
                            @foreach($applications as $application)
                                @php $listing = $application->getListing(); @endphp
                                @if($listing)
                                    <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition group">
                                        <div class="flex items-center gap-4 min-w-0">
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                                                @if($application->listing_type === 'internship') bg-indigo-50 @else bg-blue-50 @endif">
                                                <svg class="w-5 h-5 @if($application->listing_type === 'internship') text-indigo-500 @else text-blue-500 @endif"
                                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($application->listing_type === 'internship')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    @endif
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-semibold text-gray-900 truncate group-hover:text-blue-700 transition">{{ $listing->title }}</p>
                                                <p class="text-xs text-gray-400 mt-0.5 capitalize">
                                                    {{ $application->listing_type }} &bull; Applied {{ $application->applied_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        <span class="ml-4 flex-shrink-0 text-xs font-bold px-3 py-1 rounded-lg
                                            @if($application->status === 'accepted') bg-emerald-50 text-emerald-700
                                            @elseif($application->status === 'rejected') bg-red-50 text-red-600
                                            @elseif($application->status === 'reviewed') bg-blue-50 text-blue-700
                                            @else bg-gray-100 text-gray-500 @endif">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Quick actions --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="/jobs" class="group bg-white rounded-2xl border border-blue-100 shadow-sm p-5 hover:shadow-md hover:border-blue-300 transition flex items-center gap-4">
                        <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm group-hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Browse Jobs</p>
                            <p class="text-xs text-gray-400 mt-0.5">Find your next position</p>
                        </div>
                    </a>
                    <a href="/internships" class="group bg-white rounded-2xl border border-blue-100 shadow-sm p-5 hover:shadow-md hover:border-indigo-300 transition flex items-center gap-4">
                        <div class="w-11 h-11 bg-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm group-hover:bg-indigo-700 transition">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Internships</p>
                            <p class="text-xs text-gray-400 mt-0.5">Gain hands-on experience</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layout>
