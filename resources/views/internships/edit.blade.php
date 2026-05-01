<x-layout>
    <x-slot:heading>Edit Internship: {{ $internship->title }}</x-slot:heading>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 p-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-1">Edit Internship Details</h2>
            <p class="text-sm text-gray-500 mb-6">Update the information below to modify this internship listing.</p>

            <form method="POST" action="/internships/{{ $internship->id }}">
                @csrf
                @method('PATCH')

                <div class="space-y-5">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Internship Title <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $internship->title) }}"
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
                                value="{{ old('duration', $internship->duration) }}"
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

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input
                                type="text"
                                name="location"
                                id="location"
                                value="{{ old('location', $internship->location) }}"
                                placeholder="e.g. Riga"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            >
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
                        >{{ old('description', $internship->description) }}</textarea>
                    </div>

                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">Requirements</label>
                        <textarea
                            name="requirements"
                            id="requirements"
                            rows="4"
                            placeholder="List required skills, courses, or qualifications..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-y"
                        >{{ old('requirements', $internship->requirements) }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <button
                        type="button"
                        onclick="if(confirm('Are you sure you want to delete this internship?')) document.getElementById('delete-form').submit()"
                        class="text-sm font-medium text-red-600 hover:text-red-800 transition"
                    >
                        Delete Internship
                    </button>
                    <div class="flex items-center gap-4">
                        <a href="/internships/{{ $internship->id }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">Update Internship</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form method="POST" action="/internships/{{ $internship->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
