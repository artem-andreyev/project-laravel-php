<x-layout>
    <x-slot:heading>Admin — Users</x-slot:heading>

    <div class="mb-4 flex items-center gap-3">
        <a href="/admin" class="text-sm text-gray-400 hover:text-gray-700 transition">← Dashboard</a>
    </div>

    <!-- Filters -->
    <form method="GET" class="bg-white rounded-2xl border border-blue-100 shadow-sm p-4 mb-4 flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email…"
            class="flex-1 min-w-48 border border-gray-200 bg-gray-50 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
        <select name="role" class="border border-gray-200 bg-gray-50 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">All roles</option>
            <option value="job_seeker" {{ request('role')==='job_seeker' ? 'selected' : '' }}>Job Seeker</option>
            <option value="student"    {{ request('role')==='student'    ? 'selected' : '' }}>Student</option>
            <option value="employer"   {{ request('role')==='employer'   ? 'selected' : '' }}>Employer</option>
            <option value="admin"      {{ request('role')==='admin'      ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition">Filter</button>
        <a href="/admin/users" class="text-sm text-gray-400 hover:text-gray-700 py-2 transition">Reset</a>
    </form>

    <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-900">All Users <span class="text-gray-400 font-normal text-sm">({{ $users->total() }})</span></h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">User</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Email</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Role</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Joined</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-xs font-bold">{{ strtoupper(substr($user->first_name,0,1)) }}{{ strtoupper(substr($user->last_name,0,1)) }}</span>
                                </div>
                                <span class="font-semibold text-gray-900">{{ $user->full_name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-3 text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-3">
                            <form method="POST" action="/admin/users/{{ $user->id }}/role" class="flex items-center gap-2">
                                @csrf @method('PATCH')
                                <select name="role" class="border border-gray-200 rounded-lg px-2 py-1 text-xs focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50">
                                    <option value="job_seeker" {{ $user->role==='job_seeker' ? 'selected':'' }}>Job Seeker</option>
                                    <option value="student"    {{ $user->role==='student'    ? 'selected':'' }}>Student</option>
                                    <option value="employer"   {{ $user->role==='employer'   ? 'selected':'' }}>Employer</option>
                                    <option value="admin"      {{ $user->role==='admin'      ? 'selected':'' }}>Admin</option>
                                </select>
                                <button type="submit" class="text-xs bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold px-2.5 py-1 rounded-lg transition">Save</button>
                            </form>
                        </td>
                        <td class="px-6 py-3 text-gray-400 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-3">
                            <form method="POST" action="/admin/users/{{ $user->id }}"
                                  onsubmit="return confirm('Delete {{ addslashes($user->full_name) }}?')">
                                @csrf @method('DELETE')
                                <button class="text-xs text-red-500 hover:text-red-700 font-semibold transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">{{ $users->links() }}</div>
    </div>
</x-layout>
