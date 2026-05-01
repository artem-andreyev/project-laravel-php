<x-layout>
    <x-slot:heading>Admin - Jobs</x-slot:heading>

    <div class="mb-4 flex items-center gap-3">
        <a href="/admin" class="text-sm text-gray-500 hover:text-gray-700 transition">← Back to Dashboard</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="font-semibold text-gray-900">All Jobs <span class="text-gray-400 font-normal text-sm">({{ $jobs->total() }})</span></h2>
            <a href="/jobs/create" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-2 rounded-md transition">+ Post Job</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Job Title</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Employer</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Salary</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Type</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Location</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Posted</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($jobs as $job)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <a href="/jobs/{{ $job->id }}" class="font-medium text-gray-900 hover:text-blue-600 transition">{{ $job->title }}</a>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $job->employer->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $job->salary }}</td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 capitalize">{{ str_replace('-', ' ', $job->job_type ?? 'full-time') }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ $job->location ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ $job->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="/jobs/{{ $job->id }}/edit" class="text-xs text-blue-600 hover:text-blue-800 font-medium transition">Edit</a>
                                    <form method="POST" action="/admin/jobs/{{ $job->id }}" onsubmit="return confirm('Delete this job?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-xs text-red-600 hover:text-red-800 font-medium transition">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
