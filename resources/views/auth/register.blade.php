<x-layout>
    <x-slot:heading>{{ __('auth.createAccount') }}</x-slot:heading>

    <div class="max-w-lg mx-auto">
        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">

            <div class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h2 class="text-lg font-bold text-gray-900">{{ __('auth.joinTitle') }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ __('auth.joinSubtitle') }}</p>
            </div>

            <form method="POST" action="/register" class="px-8 py-6 space-y-5">
                @csrf

                <!-- Role selector -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('auth.roleLabel') }}</label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([
                            ['value' => 'job_seeker', 'label' => __('auth.role.jobSeeker'), 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                            ['value' => 'student',    'label' => __('auth.role.student'),    'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'],
                            ['value' => 'employer',   'label' => __('auth.role.employer'),   'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 00-1-1h-2a1 1 0 00-1 1v5m4 0H9'],
                        ] as $r)
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="{{ $r['value'] }}" class="sr-only peer" {{ old('role') === $r['value'] ? 'checked' : '' }}>
                            <div class="flex flex-col items-center gap-2 p-3 rounded-xl border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-blue-300 transition text-center">
                                <svg class="w-6 h-6 text-gray-400 peer-checked:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $r['icon'] }}"/>
                                </svg>
                                <span class="text-xs font-semibold text-gray-600">{{ $r['label'] }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('role')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-gray-100"></div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('auth.firstName') }} <span class="text-red-400">*</span></label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition">
                        @error('first_name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('auth.lastName') }} <span class="text-red-400">*</span></label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition">
                        @error('last_name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('auth.email') }} <span class="text-red-400">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition">
                    @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('auth.password') }} <span class="text-red-400">*</span></label>
                        <input type="password" name="password" id="password" required
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition">
                        @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('auth.passwordConfirm') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white outline-none transition">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl text-sm transition shadow-sm hover:shadow-md">
                    {{ __('auth.createAccount') }}
                </button>

                <p class="text-center text-sm text-gray-500">
                    {{ __('auth.haveAccount') }}
                    <a href="/login" class="text-blue-600 font-semibold hover:underline">{{ __('auth.login') }}</a>
                </p>
            </form>
        </div>
    </div>
</x-layout>
