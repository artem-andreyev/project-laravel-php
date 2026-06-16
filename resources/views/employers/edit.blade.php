<x-layout>
    <x-slot:heading>Edit Company Profile</x-slot:heading>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 p-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-1">Update Company Information</h2>
            <p class="text-sm text-gray-500 mb-6">Manage your company details and profile information.</p>

            <form method="POST" action="/employer/{{ $employer->id }}">
                @csrf
                @method('PATCH')

                <div class="space-y-5">
                    <!-- Company Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Company Name <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $employer->name) }}"
                            placeholder="e.g. TechCorp Latvia"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            required
                            maxlength="100"
                        >
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Industry -->
                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                        <input
                            type="text"
                            name="industry"
                            id="industry"
                            value="{{ old('industry', $employer->industry) }}"
                            placeholder="e.g. Information Technology, Manufacturing"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            maxlength="100"
                        >
                        @error('industry')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <input
                            type="text"
                            name="address"
                            id="address"
                            value="{{ old('address', $employer->address) }}"
                            placeholder="e.g. Bruņinieku iela 165, Rīga"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            maxlength="150"
                        >
                        @error('address')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Website -->
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                        <input
                            type="url"
                            name="website"
                            id="website"
                            value="{{ old('website', $employer->website) }}"
                            placeholder="e.g. https://company.lv"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            maxlength="200"
                        >
                        @error('website')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Company Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="6"
                            placeholder="Tell us about your company, your mission, and what makes you special..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"
                            maxlength="2000"
                        >{{ old('description', $employer->description) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Maximum 2000 characters</p>
                        @error('description')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 flex gap-4">
                    <button
                        type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition"
                    >
                        Update Company Profile
                    </button>
                    <a
                        href="/profile"
                        class="flex-1 text-center border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-2.5 rounded-lg transition"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
