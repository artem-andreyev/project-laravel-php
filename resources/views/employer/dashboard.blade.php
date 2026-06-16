<x-layout>
    <x-slot:heading>Employer Dashboard</x-slot:heading>

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Stats --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @foreach([
                ['label'=>'Jobs Posted',   'value'=>$stats['jobs'],         'color'=>'blue'],
                ['label'=>'Internships',   'value'=>$stats['internships'],  'color'=>'indigo'],
                ['label'=>'Applications',  'value'=>$stats['applications'], 'color'=>'emerald'],
                ['label'=>'Pending',       'value'=>$stats['pending'],      'color'=>'amber'],
            ] as $s)
            <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">{{ $s['label'] }}</p>
                <p class="text-3xl font-extrabold text-gray-900">{{ $s['value'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Quick actions --}}
        <div class="flex flex-wrap gap-3">
            <a href="/jobs/create" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Post Job
            </a>
            <a href="/internships/create" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Post Internship
            </a>
            <a href="/employer/applications" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm border border-gray-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                All Applications
            </a>
            <a href="/saved" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm border border-gray-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                Saved
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- My Jobs --}}
            <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest">My Jobs</h3>
                    <a href="/jobs/create" class="text-xs font-semibold text-blue-600 hover:text-blue-800">+ New</a>
                </div>
                @if($jobs->isEmpty())
                    <p class="text-sm text-gray-400 text-center py-10">No jobs posted yet.</p>
                @else
                    <div class="divide-y divide-gray-50">
                        @foreach($jobs as $job)
                        <div class="flex items-center justify-between px-5 py-3 hover:bg-gray-50 transition">
                            <div class="min-w-0">
                                <a href="/jobs/{{ $job->id }}" class="text-sm font-semibold text-gray-900 hover:text-blue-700 truncate block">{{ $job->title }}</a>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $job->applications_count }} application{{ $job->applications_count !== 1 ? 's' : '' }} &bull; {{ $job->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex items-center gap-2 ml-3">
                                <a href="/jobs/{{ $job->id }}/edit" class="text-xs font-semibold text-blue-600 hover:text-blue-800 px-2 py-1 bg-blue-50 rounded-lg transition">Edit</a>
                                <form method="POST" action="/jobs/{{ $job->id }}" onsubmit="return confirm('Delete this job?')">
                                    @csrf @method('DELETE')
                                    <button class="text-xs font-semibold text-red-400 hover:text-red-600 px-2 py-1 bg-red-50 rounded-lg transition">Del</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- My Internships --}}
            <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest">My Internships</h3>
                    <a href="/internships/create" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">+ New</a>
                </div>
                @if($internships->isEmpty())
                    <p class="text-sm text-gray-400 text-center py-10">No internships posted yet.</p>
                @else
                    <div class="divide-y divide-gray-50">
                        @foreach($internships as $i)
                        <div class="flex items-center justify-between px-5 py-3 hover:bg-gray-50 transition">
                            <div class="min-w-0">
                                <a href="/internships/{{ $i->id }}" class="text-sm font-semibold text-gray-900 hover:text-indigo-700 truncate block">{{ $i->title }}</a>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $i->applications_count }} application{{ $i->applications_count !== 1 ? 's' : '' }} &bull; {{ $i->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex items-center gap-2 ml-3">
                                <a href="/internships/{{ $i->id }}/edit" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 px-2 py-1 bg-indigo-50 rounded-lg transition">Edit</a>
                                <form method="POST" action="/internships/{{ $i->id }}" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="text-xs font-semibold text-red-400 hover:text-red-600 px-2 py-1 bg-red-50 rounded-lg transition">Del</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        {{-- Recent Applications --}}
        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Recent Applications</h3>
                <a href="/employer/applications" class="text-xs font-semibold text-blue-600 hover:text-blue-800">View all →</a>
            </div>
            @if($recentApplications->isEmpty())
                <p class="text-sm text-gray-400 text-center py-10">No applications yet.</p>
            @else
                <div class="divide-y divide-gray-50">
                    @foreach($recentApplications as $app)
                    @php $listing = $app->getListing(); @endphp
                    <div class="flex items-center justify-between px-6 py-3 hover:bg-gray-50 transition">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-white text-xs font-bold">{{ strtoupper(substr($app->user->first_name??'?',0,1)) }}</span>
                            </div>
                            <div class="min-w-0">
                                <a href="/users/{{ $app->user->id }}/profile" class="text-sm font-semibold text-gray-900 hover:text-blue-700 truncate block transition">{{ $app->user->full_name ?? '—' }}</a>
                                <p class="text-xs text-gray-400 truncate">{{ $listing?->title ?? 'Deleted listing' }} &bull; {{ $app->applied_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 ml-3 flex-shrink-0">
                            <form method="POST" action="/employer/applications/{{ $app->id }}/status" class="flex items-center gap-1.5">
                                @csrf @method('PATCH')
                                <select name="status" class="border border-gray-200 rounded-lg px-2 py-1 text-xs bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none">
                                    @foreach(['pending','reviewed','accepted','rejected'] as $s)
                                        <option value="{{ $s }}" {{ $app->status === $s ? 'selected':'' }}>{{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2 py-1 rounded-lg transition">Save</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout>
