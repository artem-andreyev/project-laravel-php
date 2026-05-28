<x-layout>
    <x-slot:heading>
        {{ __('contact.heading') }}
    </x-slot:heading>

    <div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-extrabold mb-8 text-black text-center">{{ __('contact.heading') }}</h1>

        <p class="text-lg text-gray-900 mb-12 leading-relaxed">
            {{ __('contact.email') }}
        </p>

        <section class="bg-blue-50 p-8 rounded-lg shadow-inner">
            <h2 class="text-2xl font-semibold mb-5 text-black border-b-2 border-blue-300 pb-2">
                {{ __('contact.heading') }}
            </h2>
            <p class="mb-6 text-gray-900">{{ __('contact.message') }}:</p>
            <ul class="list-disc list-inside text-gray-900 space-y-2 mb-8">
                <li>{{ __('contact.email') }}: <a href="mailto:{{ __('contact.support') }}" class="text-blue-600 hover:text-blue-900 hover:underline">{{ __('contact.support') }}</a></li>
                <li>{{ __('contact.phone') }}: {{ __('contact.tel') }}</li>
                <li>{{ __('contact.address') }}: Bruņinieku iela 10</li>
            </ul>

        </section>
    </div>
</x-layout>
