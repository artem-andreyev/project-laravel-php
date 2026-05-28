@php
    $current = app()->getLocale();
    $enUrl = request()->fullUrlWithQuery(['lang' => 'en']);
    $lvUrl = request()->fullUrlWithQuery(['lang' => 'lv']);
@endphp

<details class="relative border-l border-gray-200 pl-4 group">
    <summary
        class="flex items-center gap-2 text-xs font-semibold text-gray-700 hover:text-blue-600 py-2 px-3 rounded-lg hover:bg-gray-100 transition cursor-pointer select-none [&::-webkit-details-marker]:hidden">
        <span>{{ $current === 'en' ? 'EN' : 'LV' }}</span>
        <svg class="w-3 h-3 transition duration-300 group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </summary>

    <div class="absolute right-0 mt-2 w-44 bg-white rounded-lg shadow-lg border border-gray-200 z-50 overflow-hidden">
        <a href="{{ $enUrl }}"
           class="block w-full text-left px-4 py-2.5 text-sm font-medium {{ $current === 'en' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition">
            {{ __('english') }}
        </a>
        <a href="{{ $lvUrl }}"
           class="block w-full text-left px-4 py-2.5 text-sm font-medium {{ $current === 'lv' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }} transition">
            {{ __('latvian') }}
        </a>
    </div>
</details>
