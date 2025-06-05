<x-layout>
    <x-slot:heading>
        Internship
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $internship->title }}</h2>
    <p>
        This internship lasts {{ $internship->duration }} months.
    </p>

    <div class="mt-4">
        <p class="text-sm text-gray-600">
            Offered by: {{ $internship->employer->name }}
        </p>
    </div>

    @auth
        <p class="mt-6">
            <x-button href="/internships/{{ $internship->id }}/edit">Edit Internship</x-button>
        </p>
    @endauth
</x-layout>
