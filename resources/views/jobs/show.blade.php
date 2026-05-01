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
                <div class="flex flex-wrap gap-2 mb-5">
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full capitalize">{{ str_replace('-', ' ', $job->job_type ?? 'full-time') }}</span>
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
                        <h3 class="font-semibold text-gray-900 mb-2 text-base">Job Description</h3>
                        <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $job->description }}</div>
                    </div>
                @endif

                @if($job->requirements)
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2 text-base">Requirements</h3>
                        <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $job->requirements }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-4">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Apply for this Position</h3>
                @guest
                    <p class="text-sm text-gray-500 mb-4">Please log in to apply for this position.</p>
                    <a href="/login" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">Log In to Apply</a>
                @endguest
                @auth
                    @if($hasApplied)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                            <p class="text-green-700 font-semibold text-sm">Already Applied</p>
                            <a href="/applications" class="text-green-600 hover:underline text-xs mt-1 block">View your applications</a>
                        </div>
                    @else
                        <form method="POST" action="/applications">
                            @csrf
                            <input type="hidden" name="listing_type" value="job">
                            <input type="hidden" name="listing_id" value="{{ $job->id }}">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cover Letter <span class="text-gray-400 font-normal">(optional)</span></label>
                            <textarea
                                name="cover_letter"
                                rows="5"
                                placeholder="Tell the employer why you are a great fit..."
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none mb-3"
                            ></textarea>
                            @error('cover_letter')
                                <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">Apply Now</button>
                        </form>
                    @endif

                    @if(Auth::user()->isAdmin() || (Auth::user()->employer && Auth::user()->employer->id == $job->employer_id))
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="/jobs/{{ $job->id }}/edit" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 rounded-lg transition text-sm">Edit Job</a>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h4 class="font-semibold text-gray-900 mb-3">Job Details</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex justify-between">
                        <span class="font-medium text-gray-700">Salary:</span>
                        <span>{{ $job->salary }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-medium text-gray-700">Type:</span>
                        <span class="capitalize">{{ str_replace('-', ' ', $job->job_type ?? 'Full-time') }}</span>
                    </li>
                    @if($job->location)
                        <li class="flex justify-between">
                            <span class="font-medium text-gray-700">Location:</span>
                            <span>{{ $job->location }}</span>
                        </li>
                    @endif
                    @if($job->industry)
                        <li class="flex justify-between">
                            <span class="font-medium text-gray-700">Industry:</span>
                            <span>{{ $job->industry }}</span>
                        </li>
                    @endif
                    <li class="flex justify-between">
                        <span class="font-medium text-gray-700">Posted:</span>
                        <span>{{ $job->created_at->format('M d, Y') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @auth
        @if(Auth::user()->isAdmin())
            <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                <p class="text-sm font-semibold text-yellow-800 mb-3">Admin Actions</p>
                <div class="flex gap-3">
                    <a href="/jobs/{{ $job->id }}/edit" class="text-sm bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2 rounded-lg transition">Edit</a>
                    <form method="POST" action="/jobs/{{ $job->id }}" onsubmit="return confirm('Delete this job?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm bg-red-50 border border-red-300 hover:bg-red-100 text-red-700 font-medium px-4 py-2 rounded-lg transition">Delete</button>
                    </form>
                </div>
            </div>
        @endif
    @endauth
</x-layout>
