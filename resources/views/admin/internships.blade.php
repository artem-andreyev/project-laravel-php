<x-layout>
    <x-slot:heading>Admin — Internships</x-slot:heading>

    <div class="mb-4"><a href="/admin" class="text-sm text-gray-400 hover:text-gray-700 transition">← Dashboard</a></div>

    <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-900">All Internships <span class="text-gray-400 font-normal text-sm">({{ $internships->total() }})</span></h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Title</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Employer</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Duration</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Location</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Posted</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($internships as $internship)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <a href="/internships/{{ $internship->id }}" class="font-semibold text-gray-900 hover:text-blue-600 transition">{{ $internship->title }}</a>
                        </td>
                        <td class="px-6 py-3 text-gray-500">{{ $internship->employer->name ?? '—' }}</td>
                        <td class="px-6 py-3"><span class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700">{{ $internship->duration }}</span></td>
                        <td class="px-6 py-3 text-gray-400 text-xs">{{ $internship->location ?? '—' }}</td>
                        <td class="px-6 py-3 text-gray-400 text-xs">{{ $internship->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <a href="/internships/{{ $internship->id }}/edit" class="text-xs text-blue-600 hover:text-blue-800 font-semibold transition">Edit</a>
                                <form method="POST" action="/admin/internships/{{ $internship->id }}" onsubmit="return confirm('Delete this internship?')">
                                    @csrf @method('DELETE')
                                    <button class="text-xs text-red-500 hover:text-red-700 font-semibold transition">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">{{ $internships->links() }}</div>
    </div>
</x-layout>
