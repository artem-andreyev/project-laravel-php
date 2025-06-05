<x-layout>
    <x-slot:heading>
        Create Internship
    </x-slot:heading>

    <form method="POST" action="/internships">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create a New Internship</h2>
                <p class="mt-1 text-sm/6 text-gray-600">We just need a few details about the internship position.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">Title</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="title" id="title" placeholder="Software Development Intern" required/>
                            <x-form-error name="title" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="duration">Duration (months)</x-form-label>
                        <div class="mt-2">
                            <x-form-input
                                type="number"
                                name="duration"
                                id="duration"
                                placeholder="3"
                                min="1"
                                max="12"
                                required/>
                            <x-form-error name="duration" />
                        </div>
                    </x-form-field>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/internships" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <x-form-button>Create</x-form-button>
        </div>
    </form>
</x-layout>
