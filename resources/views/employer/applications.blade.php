<x-layout>
    <x-slot:heading>Applications</x-slot:heading>

    <div class="max-w-5xl mx-auto">
        <div class="mb-4 flex items-center gap-3">
            <a href="/employer/dashboard" class="text-sm text-gray-400 hover:text-gray-700 transition">← Dashboard</a>
        </div>

        {{-- Filter --}}
        <form method="GET" class="bg-white rounded-2xl border border-blue-100 shadow-sm p-4 mb-5 flex flex-wrap gap-3">
            <select name="status" class="border border-gray-200 bg-gray-50 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="">All statuses</option>
                @foreach(['pending','reviewed','accepted','rejected'] as $s)
                    <option value="{{ $s }}" {{ request('status')===$s ? 'selected':'' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition">Filter</button>
            <a href="/employer/applications" class="text-sm text-gray-400 hover:text-gray-700 py-2 transition">Reset</a>
        </form>

        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-900">All Applications <span class="text-gray-400 font-normal text-sm">({{ $applications->total() }})</span></h2>
            </div>
            @if($applications->isEmpty())
                <p class="text-sm text-gray-400 text-center py-16">No applications found.</p>
            @else
                <div class="divide-y divide-gray-50">
                    @foreach($applications as $app)
                    @php $listing = $app->getListing(); @endphp
                    <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="text-white text-sm font-bold">{{ strtoupper(substr($app->user->first_name??'?',0,1)) }}</span>
                            </div>
                            <div class="min-w-0">
                                <a href="/users/{{ $app->user->id }}/profile" class="text-sm font-bold text-gray-900 hover:text-blue-700 transition">{{ $app->user->full_name ?? '—' }}</a>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $listing?->title ?? 'Deleted listing' }}
                                    &bull; <span class="capitalize">{{ $app->listing_type }}</span>
                                    &bull; {{ $app->applied_at->format('d M Y') }}
                                </p>
                                @if($app->cover_letter)
                                    <p class="text-xs text-gray-500 mt-1 italic line-clamp-1">"{{ $app->cover_letter }}"</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2 ml-4 flex-shrink-0">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-lg
                                @if($app->status==='accepted') bg-emerald-50 text-emerald-700
                                @elseif($app->status==='rejected') bg-red-50 text-red-600
                                @elseif($app->status==='reviewed') bg-blue-50 text-blue-700
                                @else bg-gray-100 text-gray-500 @endif">
                                {{ ucfirst($app->status) }}
                            </span>
                            <form method="POST" action="/employer/applications/{{ $app->id }}/status" class="flex items-center gap-1.5">
                                @csrf @method('PATCH')
                                <select name="status" class="border border-gray-200 rounded-lg px-2 py-1 text-xs bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none">
                                    @foreach(['pending','reviewed','accepted','rejected'] as $s)
                                        <option value="{{ $s }}" {{ $app->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2.5 py-1 rounded-lg transition">Save</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="px-6 py-4 border-t border-gray-100">{{ $applications->links() }}</div>
            @endif
        </div>
    </div>
</x-layout>
