<x-layout>
    <x-slot:heading>Admin — Applications</x-slot:heading>

    <div class="mb-4"><a href="/admin" class="text-sm text-gray-400 hover:text-gray-700 transition">← Dashboard</a></div>

    <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">All Applications <span class="text-gray-400 font-normal text-sm">({{ $applications->total() }})</span></h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Applicant</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Type</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Listing ID</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Applied</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($applications as $app)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <span class="text-blue-700 text-xs font-bold">{{ strtoupper(substr($app->user->first_name??'?',0,1)) }}</span>
                                </div>
                                <span class="font-medium text-gray-900">{{ $app->user->full_name ?? '—' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-3">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-lg capitalize
                                {{ $app->listing_type === 'internship' ? 'bg-indigo-50 text-indigo-700' : 'bg-blue-50 text-blue-700' }}">
                                {{ $app->listing_type }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-gray-500">#{{ $app->listing_id }}</td>
                        <td class="px-6 py-3">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-lg
                                @if($app->status==='accepted') bg-emerald-50 text-emerald-700
                                @elseif($app->status==='rejected') bg-red-50 text-red-600
                                @elseif($app->status==='reviewed') bg-blue-50 text-blue-700
                                @else bg-gray-100 text-gray-500 @endif">
                                {{ ucfirst($app->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-gray-400 text-xs">{{ $app->applied_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">{{ $applications->links() }}</div>
    </div>
</x-layout>
