<x-layout>
    <x-slot:heading>{{ $internship->title }}</x-slot:heading>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $internship->title }}</h2>
                    <p class="text-blue-600 font-semibold mt-1">{{ $internship->employer->name }}</p>
                </div>
                <div class="flex flex-wrap gap-2 mb-5">
                    <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-3 py-1 rounded-full">Internship</span>
                    @if($internship->location)
                        <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-3 py-1 rounded-full">{{ $internship->location }}</span>
                    @endif
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">{{ $internship->duration }} {{ $internship->duration == 1 ? 'month' : 'months' }}</span>
                </div>

                @if($internship->description)
                    <div class="mb-5">
                        <h3 class="font-semibold text-gray-900 mb-2 text-base">Description</h3>
                        <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $internship->description }}</div>
                    </div>
                @endif

                @if($internship->requirements)
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2 text-base">Requirements</h3>
                        <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line">{{ $internship->requirements }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-4">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Apply for this Internship</h3>
                @guest
                    <p class="text-sm text-gray-500 mb-4">Please log in to apply for this internship.</p>
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
                            <input type="hidden" name="listing_type" value="internship">
                            <input type="hidden" name="listing_id" value="{{ $internship->id }}">
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

                    @if(Auth::user()->isAdmin() || (Auth::user()->employer && Auth::user()->employer->id == $internship->employer_id))
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="/internships/{{ $internship->id }}/edit" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 rounded-lg transition text-sm">Edit Internship</a>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h4 class="font-semibold text-gray-900 mb-3">Internship Details</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex justify-between">
                        <span class="font-medium text-gray-700">Duration:</span>
                        <span>{{ $internship->duration }} {{ $internship->duration == 1 ? 'month' : 'months' }}</span>
                    </li>
                    @if($internship->location)
                        <li class="flex justify-between">
                            <span class="font-medium text-gray-700">Location:</span>
                            <span>{{ $internship->location }}</span>
                        </li>
                    @endif
                    <li class="flex justify-between">
                        <span class="font-medium text-gray-700">Company:</span>
                        <span>{{ $internship->employer->name }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-medium text-gray-700">Posted:</span>
                        <span>{{ $internship->created_at->format('M d, Y') }}</span>
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
                    <a href="/internships/{{ $internship->id }}/edit" class="text-sm bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium px-4 py-2 rounded-lg transition">Edit</a>
                    <form method="POST" action="/internships/{{ $internship->id }}" onsubmit="return confirm('Delete this internship?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm bg-red-50 border border-red-300 hover:bg-red-100 text-red-700 font-medium px-4 py-2 rounded-lg transition">Delete</button>
                    </form>
                </div>
            </div>
        @endif
    @endauth
</x-layout>
