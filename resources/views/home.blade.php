<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    <!-- Hero Section -->
    <section class="py-24 px-8 text-center bg-[#1f2937] text-white">
        <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight drop-shadow-md">
            Find Your Dream Job or Internship
        </h1>
        <p class="text-xl md:text-2xl max-w-3xl mx-auto mb-12 tracking-wide">
            Search thousands of job offers and internship opportunities across Latvia.
        </p>

        <form action="/jobs" method="GET" class="max-w-xl mx-auto mt-8">
            <div class="flex">
                <input
                    type="text"
                    name="search"
                    placeholder="Search for jobs..."
                    class="w-full px-4 py-3 rounded-l-full border border-gray-300 text-black"
                >
                <button type="submit" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white px-6 py-3 rounded-r-full font-semibold">
                    Search
                </button>
            </div>
        </form>
        <form action="/internships" method="GET" class="max-w-xl mx-auto mt-8">
            <div class="flex">
                <input
                    type="text"
                    name="search"
                    placeholder="Search for internships..."
                    class="w-full px-4 py-3 rounded-l-full border border-gray-300 text-black"
                >
                <button type="submit" class="bg-[#3b82f6] hover:bg-[#2563eb] text-white px-6 py-3 rounded-r-full font-semibold">
                    Search
                </button>
            </div>
        </form>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-10 grid grid-cols-1 md:grid-cols-2 gap-12 text-center text-[#1f2937] bg-white">
        <a href="/jobs" class="block">
            <div class="rounded-xl p-10 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 bg-[#3b82f6] text-white flex flex-col items-center cursor-pointer">
                <svg class="mb-6 w-16 h-16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0z" />
                    <path d="M12 14a8 8 0 0 0-8 8h16a8 8 0 0 0-8-8z" />
                </svg>
                <h3 class="text-2xl font-semibold mb-3">Jobs</h3>
                <p class="max-w-md leading-relaxed">
                    Browse the latest job openings in various industries.
                </p>
            </div>
        </a>

        <a href="/internships" class="block">
            <div class="rounded-xl p-10 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 bg-[#3b82f6] text-white flex flex-col items-center cursor-pointer">
                <svg class="mb-6 w-16 h-16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path d="M12 14v7" />
                    <path d="M12 14L3 9" />
                </svg>
                <h3 class="text-2xl font-semibold mb-3">Internships</h3>
                <p class="max-w-md leading-relaxed">
                    Find valuable internships to gain experience and skills.
                </p>
            </div>
        </a>
    </section>
</x-layout>
