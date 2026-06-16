<x-layout>
    <x-slot:heading>Edit Job: {{ $job->title }}</x-slot:heading>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 p-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-1">Edit Job Details</h2>
            <p class="text-sm text-gray-500 mb-6">Update the information below to modify this job listing.</p>

            <form method="POST" action="/jobs/{{ $job->id }}">
                @csrf
                @method('PATCH')

                <div class="space-y-5">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Job Title <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $job->title) }}"
                            placeholder="e.g. Software Developer"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            required
                        >
                        @error('title')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Salary <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="salary"
                            id="salary"
                            value="{{ old('salary', $job->salary) }}"
                            placeholder="e.g. 1500 EUR/month"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            required
                        >
                        @error('salary')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                            <select name="job_type" id="job_type" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="full-time" {{ old('job_type', $job->job_type) == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="part-time" {{ old('job_type', $job->job_type) == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="remote" {{ old('job_type', $job->job_type) == 'remote' ? 'selected' : '' }}>Remote</option>
                                <option value="internship" {{ old('job_type', $job->job_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                        </div>

                        <div class="relative">
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location / Address</label>
                            <input
                                type="text"
                                name="location"
                                id="location"
                                value="{{ old('location', $job->location) }}"
                                placeholder="e.g. Brīvības iela 40, Rīga"
                                autocomplete="off"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            >
                            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $job->latitude) }}">
                            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $job->longitude) }}">
                            <div id="location-suggestions" class="absolute z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden"></div>
                            <p id="location-status" class="text-xs mt-1 text-gray-400"></p>
                        </div>
                    </div>

                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                        <input
                            type="text"
                            name="industry"
                            id="industry"
                            value="{{ old('industry', $job->industry) }}"
                            placeholder="e.g. Technology, Finance, Healthcare"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        >
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Job Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            placeholder="Describe the role, responsibilities, and what you are looking for..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-y"
                        >{{ old('description', $job->description) }}</textarea>
                    </div>

                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">Requirements</label>
                        <textarea
                            name="requirements"
                            id="requirements"
                            rows="4"
                            placeholder="List required skills, experience, qualifications..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-y"
                        >{{ old('requirements', $job->requirements) }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <button
                        type="button"
                        onclick="document.getElementById('delete-form').submit()"
                        class="text-sm font-medium text-red-600 hover:text-red-800 transition"
                        onclick="return confirm('Are you sure you want to delete this job?')"
                    >
                        Delete Job
                    </button>
                    <div class="flex items-center gap-4">
                        <a href="/jobs/{{ $job->id }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">Update Job</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form method="POST" action="/jobs/{{ $job->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @include('components.location-autocomplete')
</x-layout>
