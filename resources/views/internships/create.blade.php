<x-layout>
    <x-slot:heading>Post a New Internship</x-slot:heading>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 p-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-1">Internship Details</h2>
            <p class="text-sm text-gray-500 mb-6">Fill in the information below to post a new internship listing.</p>

            <form method="POST" action="/internships">
                @csrf

                <div class="space-y-5">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Internship Title <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            placeholder="e.g. Software Development Intern"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            required
                        >
                        @error('title')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (months) <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                name="duration"
                                id="duration"
                                value="{{ old('duration') }}"
                                placeholder="e.g. 3"
                                min="1"
                                max="24"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                required
                            >
                            @error('duration')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative">
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location / Address</label>
                            <input
                                type="text"
                                name="location"
                                id="location"
                                value="{{ old('location', 'Rīga') }}"
                                placeholder="e.g. Brīvības iela 40, Rīga"
                                autocomplete="off"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            >
                            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                            <div id="location-suggestions" class="absolute z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden"></div>
                            <p id="location-status" class="text-xs mt-1 text-gray-400"></p>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            placeholder="Describe the internship, responsibilities, and what the intern will learn..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-y"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">Requirements</label>
                        <textarea
                            name="requirements"
                            id="requirements"
                            rows="4"
                            placeholder="List required skills, courses, or qualifications..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-y"
                        >{{ old('requirements') }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="/internships" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Cancel</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">Post Internship</button>
                </div>
            </form>
        </div>
    </div>

    @include('components.location-autocomplete')
</x-layout>
