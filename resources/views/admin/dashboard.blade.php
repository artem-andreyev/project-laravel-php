<x-layout>
    <x-slot:heading>Admin Dashboard</x-slot:heading>

    <!-- Stats -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        @foreach([
            ['label'=>'Users',        'value'=>$stats['users'],        'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color'=>'blue',   'href'=>'/admin/users'],
            ['label'=>'Jobs',         'value'=>$stats['jobs'],         'icon'=>'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color'=>'emerald','href'=>'/admin/jobs'],
            ['label'=>'Internships',  'value'=>$stats['internships'],  'icon'=>'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z', 'color'=>'indigo', 'href'=>'/admin/internships'],
            ['label'=>'Applications', 'value'=>$stats['applications'], 'icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color'=>'amber',  'href'=>'/admin/applications'],
        ] as $s)
        <a href="{{ $s['href'] }}" class="bg-white rounded-2xl border border-blue-100 shadow-sm p-5 hover:shadow-md transition group">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">{{ $s['label'] }}</p>
                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-{{ $s['color'] }}-50 group-hover:bg-{{ $s['color'] }}-100 transition">
                    <svg class="w-4 h-4 text-{{ $s['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/></svg>
                </div>
            </div>
            <p class="text-3xl font-extrabold text-gray-900">{{ $s['value'] }}</p>
        </a>
        @endforeach
    </div>

    <!-- Role breakdown -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        @foreach([
            ['label'=>'Employers',   'value'=>$stats['employers'],   'color'=>'emerald'],
            ['label'=>'Students',    'value'=>$stats['students'],    'color'=>'blue'],
            ['label'=>'Job Seekers', 'value'=>$stats['job_seekers'], 'color'=>'indigo'],
        ] as $r)
        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-10 h-10 bg-{{ $r['color'] }}-50 rounded-xl flex items-center justify-center">
                <span class="text-{{ $r['color'] }}-600 font-extrabold text-sm">{{ $r['value'] }}</span>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-900">{{ $r['label'] }}</p>
                <p class="text-xs text-gray-400">registered users</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-6">
        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Quick Actions</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            @foreach([
                ['href'=>'/admin/users',        'label'=>'Manage Users',       'sub'=>'Roles & accounts',  'color'=>'blue'],
                ['href'=>'/admin/jobs',          'label'=>'Manage Jobs',        'sub'=>'Review listings',   'color'=>'emerald'],
                ['href'=>'/admin/internships',   'label'=>'Internships',        'sub'=>'Review listings',   'color'=>'indigo'],
                ['href'=>'/admin/applications',  'label'=>'Applications',       'sub'=>'All submissions',   'color'=>'amber'],
            ] as $a)
            <a href="{{ $a['href'] }}"
               class="flex flex-col gap-1 p-4 bg-gray-50 hover:bg-{{ $a['color'] }}-50 border border-gray-200 hover:border-{{ $a['color'] }}-200 rounded-xl transition group">
                <span class="text-sm font-bold text-gray-900 group-hover:text-{{ $a['color'] }}-700">{{ $a['label'] }}</span>
                <span class="text-xs text-gray-400">{{ $a['sub'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</x-layout>
