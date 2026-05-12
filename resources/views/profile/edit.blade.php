<x-layout>
    <x-slot:heading>Edit Profile</x-slot:heading>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">

            <!-- Card Header -->
            <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Personal Information</h2>
                        <p class="text-sm text-gray-500">Update your profile details below.</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="/profile" enctype="multipart/form-data">
                @csrf

                <div class="px-8 py-6 space-y-6">

                    <!-- Name section -->
                    <div>
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-widest mb-4">Basic Info</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    First Name <span class="text-red-400">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="first_name"
                                    id="first_name"
                                    value="{{ old('first_name', $user->first_name) }}"
                                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition"
                                    required
                                >
                                @error('first_name')
                                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Last Name <span class="text-red-400">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="last_name"
                                    id="last_name"
                                    value="{{ old('last_name', $user->last_name) }}"
                                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition"
                                    required
                                >
                                @error('last_name')
                                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100"></div>

                    <!-- Contact section -->
                    <div>
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-widest mb-4">Contact & Location</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1.5">Phone</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </span>
                                    <input
                                        type="tel"
                                        name="phone"
                                        id="phone"
                                        value="{{ old('phone', $profile->phone) }}"
                                        placeholder="+371 20 000 000"
                                        class="w-full border border-gray-200 bg-gray-50 rounded-xl pl-10 pr-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition"
                                    >
                                </div>
                            </div>

                            <div>
                                <label for="location" class="block text-sm font-semibold text-gray-700 mb-1.5">Location</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </span>
                                    <input
                                        type="text"
                                        name="location"
                                        id="location"
                                        value="{{ old('location', $profile->location) }}"
                                        placeholder="e.g. Riga, Latvia"
                                        class="w-full border border-gray-200 bg-gray-50 rounded-xl pl-10 pr-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100"></div>

                    <!-- Professional section -->
                    <div>
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-widest mb-4">Professional Details</p>
                        <div class="space-y-5">

                            <div>
                                <label for="bio" class="block text-sm font-semibold text-gray-700 mb-1.5">About Me</label>
                                <textarea
                                    name="bio"
                                    id="bio"
                                    rows="4"
                                    placeholder="Write a short bio about yourself..."
                                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition resize-y"
                                >{{ old('bio', $profile->bio) }}</textarea>
                                @error('bio')
                                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="skills" class="block text-sm font-semibold text-gray-700 mb-1.5">Skills</label>
                                <input
                                    type="text"
                                    name="skills"
                                    id="skills"
                                    value="{{ old('skills', $profile->skills) }}"
                                    placeholder="e.g. PHP, Laravel, JavaScript, MySQL"
                                    class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition"
                                >
                                <p class="text-xs text-gray-400 mt-1.5">Separate skills with commas</p>
                                @error('skills')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="education" class="block text-sm font-semibold text-gray-700 mb-1.5">Education</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                    </span>
                                    <input
                                        type="text"
                                        name="education"
                                        id="education"
                                        value="{{ old('education', $profile->education) }}"
                                        placeholder="e.g. BSc Computer Science, University of Latvia"
                                        class="w-full border border-gray-200 bg-gray-50 rounded-xl pl-10 pr-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition"
                                    >
                                </div>
                            </div>

                            <div>
                                <label for="website" class="block text-sm font-semibold text-gray-700 mb-1.5">Website / LinkedIn</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </span>
                                    <input
                                        type="url"
                                        name="website"
                                        id="website"
                                        value="{{ old('website', $profile->website) }}"
                                        placeholder="https://yourwebsite.com"
                                        class="w-full border border-gray-200 bg-gray-50 rounded-xl pl-10 pr-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition"
                                    >
                                </div>
                                @error('website')
                                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="border-t border-gray-100"></div>

                    <!-- CV Upload -->
                    <div>
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-widest mb-4">CV / Resume</p>
                        @if($profile->cv_path)
                            <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl border border-blue-100 mb-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <p class="text-sm text-blue-700 font-medium">CV already uploaded. Upload a new file to replace it.</p>
                            </div>
                        @endif
                        <label for="cv" class="block text-sm font-semibold text-gray-700 mb-1.5">Upload CV</label>
                        <input
                            type="file"
                            name="cv"
                            id="cv"
                            accept=".pdf,.doc,.docx"
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm text-gray-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:transition cursor-pointer"
                        >
                        <p class="text-xs text-gray-400 mt-1.5">Accepted formats: PDF, DOC, DOCX</p>
                    </div>

                </div>

                <!-- Footer Actions -->
                <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <a href="/profile" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-900 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition-all shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-layout>
