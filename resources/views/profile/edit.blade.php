<x-layout>
    <x-slot:heading>Edit Profile</x-slot:heading>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 p-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-1">Personal Information</h2>
            <p class="text-sm text-gray-500 mb-6">Update your profile details below.</p>

            <form method="POST" action="/profile" enctype="multipart/form-data">
                @csrf

                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                            <input
                                type="text"
                                name="first_name"
                                id="first_name"
                                value="{{ old('first_name', $user->first_name) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                required
                            >
                            @error('first_name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                            <input
                                type="text"
                                name="last_name"
                                id="last_name"
                                value="{{ old('last_name', $user->last_name) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                required
                            >
                            @error('last_name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input
                                type="tel"
                                name="phone"
                                id="phone"
                                value="{{ old('phone', $profile->phone) }}"
                                placeholder="+371 20 000 000"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            >
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input
                                type="text"
                                name="location"
                                id="location"
                                value="{{ old('location', $profile->location) }}"
                                placeholder="e.g. Riga, Latvia"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">About Me</label>
                        <textarea
                            name="bio"
                            id="bio"
                            rows="4"
                            placeholder="Write a short bio about yourself..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-y"
                        >{{ old('bio', $profile->bio) }}</textarea>
                        @error('bio')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="skills" class="block text-sm font-medium text-gray-700 mb-1">Skills</label>
                        <input
                            type="text"
                            name="skills"
                            id="skills"
                            value="{{ old('skills', $profile->skills) }}"
                            placeholder="e.g. PHP, Laravel, JavaScript, MySQL"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        >
                        <p class="text-xs text-gray-400 mt-1">Separate skills with commas</p>
                        @error('skills')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="education" class="block text-sm font-medium text-gray-700 mb-1">Education</label>
                        <input
                            type="text"
                            name="education"
                            id="education"
                            value="{{ old('education', $profile->education) }}"
                            placeholder="e.g. BSc Computer Science, University of Latvia"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        >
                    </div>

                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website / LinkedIn</label>
                        <input
                            type="url"
                            name="website"
                            id="website"
                            value="{{ old('website', $profile->website) }}"
                            placeholder="https://yourwebsite.com"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        >
                        @error('website')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cv" class="block text-sm font-medium text-gray-700 mb-1">Upload CV</label>
                        @if($profile->cv_path)
                            <p class="text-xs text-gray-500 mb-2">Current CV on file. Upload a new file to replace it.</p>
                        @endif
                        <input
                            type="file"
                            name="cv"
                            id="cv"
                            accept=".pdf,.doc,.docx"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        >
                        <p class="text-xs text-gray-400 mt-1">Accepted formats: PDF, DOC, DOCX</p>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <a href="/profile" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Cancel</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
