<x-layout>
    <x-slot:heading>{{ __('jobs.heading') }}</x-slot:heading>

    <!-- Filter Bar -->
    <form method="GET" action="/jobs" class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ __('jobs.search') }}..."
                class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
            >
            <select name="job_type" class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="">{{ __('jobs.type') }}</option>
                <option value="full-time" {{ request('job_type') == 'full-time' ? 'selected' : '' }}>{{ __('jobs.type.fullTime') }}</option>
                <option value="part-time" {{ request('job_type') == 'part-time' ? 'selected' : '' }}>{{ __('jobs.type.partTime') }}</option>
                <option value="remote" {{ request('job_type') == 'remote' ? 'selected' : '' }}>{{ __('jobs.type.remote') }}</option>
                <option value="internship" {{ request('job_type') == 'internship' ? 'selected' : '' }}>{{ __('jobs.type.internship') }}</option>
            </select>
            <input
                type="text"
                name="location"
                value="{{ request('location') }}"
                placeholder="{{ __('jobs.location') }}..."
                class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none"
            >
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg text-sm transition">{{ __('home.search.button') }}</button>
                <a href="/jobs" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2.5 px-4 rounded-lg text-sm transition text-center">{{ __('buttons.reset') }}</a>
            </div>
        </div>
    </form>

    @if($jobs->isEmpty())
        <div class="text-center py-16 bg-white rounded-xl border border-gray-200">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="mt-4 text-gray-500 text-lg">{{ __('jobs.noJobs') }}</p>
            <a href="/jobs" class="mt-4 inline-block text-blue-600 hover:underline">{{ __('buttons.reset') }}</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($jobs as $job)
                <div class="relative bg-white rounded-xl border border-gray-200 hover:border-blue-300 hover:shadow-md transition group">
                    <a href="/jobs/{{ $job->id }}" class="block p-5">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 pr-10">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">{{ $job->employer->name ?? __('companies.generic') }}</span>
                                    @if($job->industry)
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">{{ $job->industry }}</span>
                                    @endif
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition">{{ $job->title }}</h3>
                                @if($job->description)
                                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($job->description, 120) }}</p>
                                @endif
                                @php
                                    $jobType = $job->job_type ?? 'full-time';
                                    $jobTypeLabels = [
                                        'full-time' => __('jobs.type.fullTime'),
                                        'part-time' => __('jobs.type.partTime'),
                                        'remote' => __('jobs.type.remote'),
                                        'internship' => __('jobs.type.internship'),
                                    ];
                                    $jobTypeLabel = $jobTypeLabels[$jobType] ?? Str::headline($jobType);
                                @endphp
                                <div class="flex flex-wrap items-center gap-4 mt-3 text-sm text-gray-500">
                                    @if($job->location)
                                        <span>{{ $job->location }}</span>
                                    @endif
                                    <span>{{ $jobTypeLabel }}</span>
                                    <span>{{ $job->salary }}</span>
                                </div>
                            </div>
                            <span class="text-xs text-gray-400 whitespace-nowrap mt-10">{{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                    @auth
                        @php $saved = auth()->user()->hasSaved('job', $job->id); @endphp
                        <form method="POST" action="/saved/toggle" class="absolute top-4 right-4">
                            @csrf
                            <input type="hidden" name="listing_type" value="job">
                            <input type="hidden" name="listing_id" value="{{ $job->id }}">
                            <button type="submit" title="{{ $saved ? __('saved.remove') : __('saved.saveJob') }}"
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
        <div class="mt-6">{{ $jobs->withQueryString()->links() }}</div>
    @endif
</x-layout>
