<x-layout>
    <x-slot:heading>
        Internships
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($internships as $internship)
            <a href="/internships/{{ $internship->id }}" class="block px-4 py-6 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                <div class="font-bold text-blue-500 text-sm">
                    {{ $internship->employer->name }}
                </div>
                <div>
                    <strong class="text-lg">{{ $internship->title }}:</strong>
                    Duration: {{ $internship->duration }} months
                </div>
            </a>
        @endforeach

        <div class="mt-6">
            {{ $internships->links() }}
        </div>
    </div>
</x-layout>
