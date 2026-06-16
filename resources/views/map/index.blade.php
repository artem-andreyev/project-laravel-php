<x-layout>
    <x-slot:heading>Jobs & Internships Map</x-slot:heading>

    <div class="max-w-7xl mx-auto">
        <!-- Map container -->
        <div id="map" style="height: 600px; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem;"></div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                <h3 class="text-lg font-semibold text-blue-900 mb-2" id="jobs-count">
                    {{ $listings->where('type', 'job')->count() }} Jobs Available
                </h3>
                <p class="text-blue-700 text-sm">Active job positions posted by employers</p>
            </div>
            <div class="bg-green-50 rounded-xl p-6 border border-green-200">
                <h3 class="text-lg font-semibold text-green-900 mb-2" id="internships-count">
                    {{ $listings->where('type', 'internship')->count() }} Internships Available
                </h3>
                <p class="text-green-700 text-sm">Internship opportunities across Latvia</p>
            </div>
        </div>

        <!-- Listings by location -->
        <div class="mt-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Opportunities by Location</h2>
                <span class="text-xs text-gray-400" id="last-updated"></span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="location-cards">
                @php
                    $locationGroups = $listings->groupBy(fn($item) => $item['location']);
                @endphp
                @foreach($locationGroups as $location => $items)
                    <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition">
                        <h3 class="font-semibold text-gray-900 mb-3 text-sm break-words">📍 {{ $location }}</h3>
                        <div class="space-y-2">
                            @foreach($items as $item)
                                <a href="{{ $item['url'] }}" class="flex items-start gap-2 p-2 rounded hover:bg-gray-50 transition text-sm">
                                    <span class="mt-1">
                                        @if($item['type'] === 'job')
                                            <span class="inline-block w-2 h-2 bg-blue-600 rounded-full"></span>
                                        @else
                                            <span class="inline-block w-2 h-2 bg-green-600 rounded-full"></span>
                                        @endif
                                    </span>
                                    <div>
                                        <p class="text-gray-900 hover:text-blue-600">{{ $item['title'] }}</p>
                                        <p class="text-gray-500 text-xs">{{ $item['date'] }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

    <style>
        .custom-marker { background: none; border: none; }
        .marker-bubble {
            background: linear-gradient(135deg, #3b82f6, #10b981);
            color: white;
            border-radius: 50%;
            width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 16px;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        .marker-bubble.jobs-only { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .marker-bubble.internships-only { background: linear-gradient(135deg, #10b981, #059669); }
    </style>

    <script>
        const map = L.map('map').setView([56.8796, 24.6032], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        let markersLayer = L.layerGroup().addTo(map);
        let currentListings = [];

        function buildPopup(coords, listings) {
            const here = listings.filter(l =>
                Math.abs(l.coords.lat - coords.lat) < 0.0001 &&
                Math.abs(l.coords.lng - coords.lng) < 0.0001
            );
            const jobs = here.filter(l => l.type === 'job').length;
            const internships = here.filter(l => l.type === 'internship').length;
            const locationName = here[0]?.location || '';

            return `
                <div style="min-width:260px">
                    <h3 style="font-weight:bold;margin:0 0 8px 0;color:#1f2937;font-size:14px">📍 ${locationName}</h3>
                    <div style="font-size:13px;color:#374151;margin-bottom:8px">
                        ${jobs > 0 ? `<span style="color:#3b82f6">●</span> <strong>${jobs}</strong> Job${jobs !== 1 ? 's' : ''}` : ''}
                        ${jobs > 0 && internships > 0 ? ' &nbsp;' : ''}
                        ${internships > 0 ? `<span style="color:#10b981">●</span> <strong>${internships}</strong> Internship${internships !== 1 ? 's' : ''}` : ''}
                    </div>
                    <hr style="margin:8px 0;border:none;border-top:1px solid #e5e7eb">
                    <div style="font-size:12px;max-height:200px;overflow-y:auto">
                        ${here.map(l => `
                            <div style="margin:4px 0;padding:4px 0;border-bottom:1px solid #f3f4f6">
                                <a href="${l.url}" style="color:#3b82f6;text-decoration:none;font-weight:500">${l.title}</a>
                                <span style="display:inline-block;padding:1px 5px;border-radius:4px;font-size:10px;font-weight:600;margin-left:4px;${l.type === 'job' ? 'background:#dbeafe;color:#1e40af' : 'background:#dcfce7;color:#15803d'}">
                                    ${l.type === 'job' ? 'JOB' : 'INTERN'}
                                </span>
                                <div style="color:#9ca3af;font-size:10px;margin-top:2px">${l.date}</div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        function renderMarkers(listings) {
            markersLayer.clearLayers();

            const seen = new Set();

            listings.forEach(item => {
                const key = `${item.coords.lat.toFixed(5)},${item.coords.lng.toFixed(5)}`;
                if (seen.has(key)) return;
                seen.add(key);

                const here = listings.filter(l =>
                    Math.abs(l.coords.lat - item.coords.lat) < 0.0001 &&
                    Math.abs(l.coords.lng - item.coords.lng) < 0.0001
                );
                const jobs = here.filter(l => l.type === 'job').length;
                const internships = here.filter(l => l.type === 'internship').length;
                const total = jobs + internships;

                let cls = 'marker-bubble';
                if (jobs === 0) cls += ' internships-only';
                else if (internships === 0) cls += ' jobs-only';

                const icon = L.divIcon({
                    html: `<div class="${cls}">${total}</div>`,
                    iconSize: [40, 40],
                    className: 'custom-marker'
                });

                L.marker([item.coords.lat, item.coords.lng], { icon })
                    .bindPopup(buildPopup(item.coords, listings), { maxWidth: 320 })
                    .addTo(markersLayer);
            });
        }

        function updateStats(listings) {
            const jobs = listings.filter(l => l.type === 'job').length;
            const internships = listings.filter(l => l.type === 'internship').length;
            const jobsEl = document.getElementById('jobs-count');
            const internEl = document.getElementById('internships-count');
            if (jobsEl) jobsEl.textContent = jobs + ' Jobs Available';
            if (internEl) internEl.textContent = internships + ' Internships Available';
            const ts = document.getElementById('last-updated');
            if (ts) ts.textContent = 'Updated ' + new Date().toLocaleTimeString();
        }

        function loadListings() {
            fetch('/api/map/listings')
                .then(r => r.json())
                .then(data => {
                    const listings = data.listings || [];
                    currentListings = listings;
                    renderMarkers(listings);
                    updateStats(listings);
                })
                .catch(err => console.error('Map load error:', err));
        }

        // Initial load
        loadListings();

        // Auto-refresh every 30 seconds to pick up new listings
        setInterval(loadListings, 30000);
    </script>
</x-layout>
