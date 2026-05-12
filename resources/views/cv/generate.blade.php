<x-layout>
    <x-slot:heading>Generate CV with AI</x-slot:heading>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">

            <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50 flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900">AI CV Generator</h2>
                    <p class="text-sm text-gray-500">Powered by GPT-4o — generates a professional CV from your profile.</p>
                </div>
            </div>

            <!-- Profile data preview -->
            @if($profile->skills || $profile->education || $profile->bio)
            <div class="mx-8 mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl text-sm text-blue-800">
                <p class="font-semibold mb-1">✓ Using your profile data:</p>
                <ul class="space-y-0.5 text-blue-700">
                    @if($profile->bio)<li>Bio: {{ Str::limit($profile->bio, 60) }}</li>@endif
                    @if($profile->skills)<li>Skills: {{ Str::limit($profile->skills, 60) }}</li>@endif
                    @if($profile->education)<li>Education: {{ Str::limit($profile->education, 60) }}</li>@endif
                </ul>
            </div>
            @else
            <div class="mx-8 mt-6 p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
                <p class="font-semibold">Your profile is empty.</p>
                <p class="mt-0.5">Fill in details below or <a href="/profile/edit" class="underline font-semibold">complete your profile</a> first for better results.</p>
            </div>
            @endif

            <form method="POST" action="/cv/generate" class="px-8 py-6 space-y-5">
                @csrf

                <div>
                    <label for="job_title" class="block text-sm font-semibold text-gray-700 mb-1.5">Target Job Title <span class="text-red-400">*</span></label>
                    <input type="text" name="job_title" id="job_title" value="{{ old('job_title') }}"
                           placeholder="e.g. PHP Developer, Marketing Manager"
                           class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition" required>
                    @error('job_title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tone</label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach(['professional'=>'Professional','creative'=>'Creative','concise'=>'Concise'] as $val => $label)
                        <label class="cursor-pointer">
                            <input type="radio" name="tone" value="{{ $val }}" class="sr-only peer" {{ old('tone','professional')===$val ? 'checked':'' }}>
                            <div class="text-center px-3 py-2.5 rounded-xl border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-blue-300 transition text-sm font-semibold text-gray-600 peer-checked:text-blue-700">
                                {{ $label }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                @if(!$profile->skills && !$profile->bio && !$profile->education)
                <div class="border-t border-gray-100 pt-5 space-y-4">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Fill in manually (optional)</p>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Bio / Summary</label>
                        <textarea name="bio" rows="3" placeholder="Brief description about yourself…"
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Skills</label>
                        <input type="text" name="skills" placeholder="PHP, Laravel, JavaScript…"
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Education</label>
                        <input type="text" name="education" placeholder="BSc Computer Science, University of Latvia"
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition">
                    </div>
                </div>
                @endif

                <button type="submit" id="gen-btn"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 rounded-xl text-sm transition shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Generate CV with AI
                </button>
            </form>
        </div>
    </div>

    <script>
    document.querySelector('form').addEventListener('submit', function() {
        const btn = document.getElementById('gen-btn');
        btn.disabled = true;
        btn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Generating…';
    });
    </script>
</x-layout>
