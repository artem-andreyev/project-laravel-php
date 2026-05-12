@props(['active' => false])

<a class="{{ $active ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} rounded-lg px-3 py-2 text-sm font-medium transition"
    aria-current="{{ $active ? 'page' : 'false' }}"
    {{ $attributes }}
>{{ $slot }}</a>