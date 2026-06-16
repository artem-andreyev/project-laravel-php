<x-layout>
    <x-slot:heading>{{ $job->title }}</x-slot:heading>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h2>
                    <p class="text-blue-600 font-semibold mt-1">{{ $job->employer->name }}</p>
                </div>
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
                <div class="flex flex-wrap gap-2 mb-5">
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full capitalize">{{ $jobTypeLabel }}</span>
                    @if($job->location)
                        <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-3 py-1 rounded-full">{{ $job->location }}</span>
                    @endif
                    @if($job->industry)
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $job->industry }}</span>
                    @endif
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $job->salary }}</span>
                </div>

                @if($job->description)
                    <div class="mb-5">
                        <h3 class="font-semibold text-gray-900 mb-2 text-base">{{ __('jobs.show.descriptionTitle') }}</h3>
                        <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $job->description }}</div>
                    </div>
                @endif

                @if($job->requirements)
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2 text-base">{{ __('jobs.show.requirementsTitle') }}</h3>
                        <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $job->requirements }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-4">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">{{ __('jobs.show.applyTitle') }}</h3>
                @guest
                    <p class="text-sm text-gray-500 mb-4">{{ __('jobs.show.applyLoginPrompt') }}</p>
                    <a href="/login" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">{{ __('jobs.show.loginToApply') }}</a>
                @endguest
                @auth
                    @if($job->is_closed)
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
                            <p class="text-red-700 font-semibold text-sm">🔒 This position has been filled</p>
                            <p class="text-red-500 text-xs mt-1">No longer accepting applications</p>
                        </div>
                    @elseif($hasApplied)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                            <p class="text-green-700 font-semibold text-sm">{{ __('applications.alreadyApplied') }}</p>
                            <a href="/applications" class="text-green-600 hover:underline text-xs mt-1 block">{{ __('applications.viewYourApplications') }}</a>
                        </div>
                    @else
                        <form method="POST" action="/applications">
                            @csrf
                            <input type="hidden" name="listing_type" value="job">
                            <input type="hidden" name="listing_id" value="{{ $job->id }}">
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('applications.coverLetter') }} <span class="text-gray-400 font-normal">({{ __('applications.coverLetterOptional') }})</span></label>
                            <textarea
                                name="cover_letter"
                                rows="5"
                                placeholder="{{ __('applications.coverLetterPlaceholder') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none mb-3"
                            ></textarea>
                            @error('cover_letter')
                                <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">{{ __('jobs.applyNow') }}</button>
                        </form>
                    @endif

                    @if(Auth::user()->isAdmin() || (Auth::user()->employer && Auth::user()->employer->id == $job->employer_id))
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="/jobs/{{ $job->id }}/edit" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 rounded-lg transition text-sm">{{ __('jobs.show.editJob') }}</a>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h4 class="font-semibold text-gray-900 mb-3">{{ __('jobs.show.detailsTitle') }}</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex justify-between">
                        <span class="font-medium text-gray-700">{{ __('jobs.show.details.salary') }}:</span>
                        <span>{{ $job->salary }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-medium text-gray-700">{{ __('jobs.show.details.type') }}:</span>
                        <span class="capitalize">{{ $jobTypeLabel }}</span>
                    </li>
                    @if($job->location)
                        <li class="flex justify-between">
                            <span class="font-medium text-gray-700">{{ __('jobs.show.details.location') }}:</span>
                            <span>{{ $job->location }}</span>
                        </li>
                    @endif
                    @if($job->industry)
                        <li class="flex justify-between">
                            <span class="font-medium text-gray-700">{{ __('jobs.show.details.industry') }}:</span>
                            <span>{{ $job->industry }}</span>
                        </li>
                    @endif
                    <li class="flex justify-between">
                        <span class="font-medium text-gray-700">{{ __('jobs.show.details.posted') }}:</span>
                        <span>{{ $job->created_at->translatedFormat('M d, Y') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Save button -->
            @auth
            <form method="POST" action="/saved/toggle">
                @csrf
                <input type="hidden" name="listing_type" value="job">
                <input type="hidden" name="listing_id" value="{{ $job->id }}">
                @php $saved = auth()->user()->hasSaved('job', $job->id); @endphp
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl border text-sm font-semibold transition
                        {{ $saved ? 'bg-blue-50 border-blue-200 text-blue-700 hover:bg-blue-100' : 'bg-white border-gray-200 text-gray-600 hover:border-blue-300 hover:text-blue-600' }}">
                    <svg class="w-4 h-4" fill="{{ $saved ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    {{ $saved ? __('saved.saved') : __('saved.saveJob') }}
                </button>
            </form>
            @endauth

            <!-- Skills match -->
            @auth
            @if(!Auth::user()->canPostListings() && $job->requirements && Auth::user()->profile && Auth::user()->profile->skills)
                @php
                    $userSkills = array_map('trim', explode(',', strtolower(Auth::user()->profile->skills)));
                    $requirements = strtolower($job->requirements . ' ' . $job->description);
                    $matched = array_filter($userSkills, fn($s) => strlen($s) > 2 && str_contains($requirements, $s));
                    $total = count($userSkills);
                    $matchCount = count($matched);
                    $pct = $total > 0 ? min(100, round($matchCount / $total * 100)) : 0;
                    $color = $pct >= 70 ? 'emerald' : ($pct >= 40 ? 'yellow' : 'red');
                @endphp
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <h4 class="font-semibold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        {{ __('jobs.show.skillsMatchTitle') }}
                    </h4>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-2xl font-extrabold text-{{ $color }}-600">{{ $pct }}%</span>
                        <span class="text-xs text-gray-500">{{ $matchCount }}/{{ $total }} {{ __('jobs.show.skills') }}</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2 mb-3">
                        <div class="bg-{{ $color }}-500 h-2 rounded-full transition-all" style="width: {{ $pct }}%"></div>
                    </div>
                    @if(count($matched) > 0)
                        <div class="flex flex-wrap gap-1">
                            @foreach(array_slice($matched, 0, 5) as $skill)
                                <span class="text-xs bg-{{ $color }}-50 text-{{ $color }}-700 border border-{{ $color }}-200 px-2 py-0.5 rounded-full">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-gray-400"><a href="/profile/edit" class="text-blue-600 hover:underline">{{ __('jobs.show.updateSkillsLink') }}</a> {{ __('jobs.show.updateSkillsSuffix') }}</p>
                    @endif
                </div>
            @elseif(!Auth::user()->canPostListings() && (!Auth::user()->profile || !Auth::user()->profile->skills))
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 text-center">
                    <p class="text-xs text-blue-700 mb-2">{{ __('jobs.show.addSkillsPrompt') }}</p>
                    <a href="/profile/edit" class="text-xs font-semibold text-blue-600 hover:underline">{{ __('jobs.show.updateProfile') }}</a>
                </div>
            @endif
            @endauth
        </div>
    </div>

    @auth
        @if(Auth::user()->isAdmin())
            <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                <p class="text-sm font-semibold text-yellow-800 mb-3">{{ __('jobs.show.adminActions') }}</p>
                <div class="flex gap-3">
                    <a href="/jobs/{{ $job->id }}/edit" class="text-sm bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2 rounded-lg transition">{{ __('buttons.edit') }}</a>
                    <form method="POST" action="/jobs/{{ $job->id }}" onsubmit="return confirm('{{ __('jobs.show.deleteConfirm') }}')">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm bg-red-50 border border-red-300 hover:bg-red-100 text-red-700 font-medium px-4 py-2 rounded-lg transition">{{ __('buttons.delete') }}</button>
                    </form>
                </div>
            </div>
        @endif
    @endauth
</x-layout>
