<x-layout>
    <x-slot:heading>{{ $user->full_name }}</x-slot:heading>

    <div class="max-w-3xl mx-auto space-y-6">

        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden">
            <div class="px-6 sm:px-8 pt-6 pb-6">
                <div class="flex items-center gap-5 mb-5">
                    <div class="w-16 h-16 rounded-2xl shadow-md flex items-center justify-center flex-shrink-0 bg-gradient-to-br from-blue-500 to-indigo-600">
                        <span class="text-white text-xl font-black">
                            {{ strtoupper(substr($user->first_name,0,1)) }}{{ strtoupper(substr($user->last_name,0,1)) }}
                        </span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-extrabold text-gray-900">{{ $user->full_name }}</h2>
                        <div class="flex flex-wrap items-center gap-2 mt-1">
                            <span class="inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-full
                                @if($user->role === 'student') bg-indigo-100 text-indigo-700
                                @else bg-blue-100 text-blue-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                            </span>
                            @if($profile->location)
                                <span class="text-xs text-gray-400">📍 {{ $profile->location }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($profile->bio)
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ $profile->bio }}</p>
                @endif

                <div class="flex flex-wrap gap-3">
                    @if($profile->phone)
                        <span class="text-xs text-gray-500 bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-lg">📞 {{ $profile->phone }}</span>
                    @endif
                    @if($profile->website)
                        <a href="{{ $profile->website }}" target="_blank" class="text-xs text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition">🔗 {{ $profile->website }}</a>
                    @endif
                    @if($profile->cv_path)
                        <a href="/users/{{ $user->id }}/cv/download" class="text-xs font-semibold text-blue-700 bg-blue-50 border border-blue-200 px-3 py-1.5 rounded-lg hover:bg-blue-100 transition flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download CV
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if($profile->skills)
            <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-6">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Skills</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(array_filter(array_map('trim', explode(',', $profile->skills))) as $skill)
                        <span class="text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100 px-3 py-1 rounded-full">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        @if($profile->education)
            <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-6">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Education</h3>
                <p class="text-sm text-gray-700 leading-relaxed">{{ $profile->education }}</p>
            </div>
        @endif

        @if($cvHtml)
            <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                    <h3 class="text-sm font-bold text-white uppercase tracking-widest">AI-Generated CV</h3>
                </div>
                <div class="px-8 py-6 space-y-5 cv-body">
                    {!! $cvHtml !!}
                </div>
            </div>
        @endif

        @if(!$profile->bio && !$profile->skills && !$profile->education && !$cvHtml)
            <div class="bg-white rounded-2xl border border-gray-100 p-10 text-center">
                <p class="text-gray-400 text-sm">This user hasn't filled in their profile yet.</p>
            </div>
        @endif

        <style>
        .cv-body h2 {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #6366f1;
            border-bottom: 2px solid #e0e7ff;
            padding-bottom: 0.4rem;
            margin-bottom: 0.75rem;
            margin-top: 0;
        }
        .cv-body p {
            color: #374151;
            line-height: 1.7;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        .cv-body ul {
            padding-left: 0;
            list-style: none;
            margin-bottom: 0.5rem;
        }
        .cv-body ul li {
            color: #374151;
            font-size: 0.9rem;
            line-height: 1.6;
            padding-left: 1.1rem;
            position: relative;
            margin-bottom: 0.3rem;
        }
        .cv-body ul li::before {
            content: "▸";
            position: absolute;
            left: 0;
            color: #6366f1;
            font-size: 0.75rem;
            top: 0.15rem;
        }
        .cv-body strong {
            color: #111827;
            font-weight: 700;
        }
        </style>

        <div class="text-center">
            <a href="{{ url()->previous() }}" class="text-sm text-gray-400 hover:text-gray-700 transition">← Back</a>
        </div>
    </div>
</x-layout>
