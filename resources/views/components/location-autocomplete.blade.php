<script>
(function () {
    const input = document.getElementById('location');
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const suggestions = document.getElementById('location-suggestions');
    const status = document.getElementById('location-status');

    if (!input) return;

    let debounceTimer;
    let currentQuery = '';

    function showStatus(msg, color) {
        if (status) {
            status.textContent = msg;
            status.className = 'text-xs mt-1 ' + (color || 'text-gray-400');
        }
    }

    function clearCoords() {
        latInput.value = '';
        lngInput.value = '';
    }

    function setCoords(lat, lng, displayName) {
        latInput.value = lat;
        lngInput.value = lng;
        showStatus('✓ ' + displayName, 'text-green-600');
    }

    function hideSuggestions() {
        suggestions.classList.add('hidden');
        suggestions.innerHTML = '';
    }

    async function search(query) {
        if (query.length < 3) {
            hideSuggestions();
            return;
        }

        try {
            const url = 'https://nominatim.openstreetmap.org/search?format=json&q=' +
                encodeURIComponent(query + ', Latvia') +
                '&limit=5&countrycodes=lv&addressdetails=1';

            const res = await fetch(url, {
                headers: { 'Accept': 'application/json' }
            });
            const data = await res.json();

            if (!data || data.length === 0) {
                hideSuggestions();
                clearCoords();
                showStatus('Address not found in Latvia', 'text-orange-500');
                return;
            }

            suggestions.innerHTML = '';
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'px-4 py-2.5 cursor-pointer hover:bg-blue-50 text-sm text-gray-700 border-b border-gray-100 last:border-0';
                div.textContent = item.display_name;
                div.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    input.value = item.display_name;
                    setCoords(parseFloat(item.lat), parseFloat(item.lon), item.display_name);
                    hideSuggestions();
                });
                suggestions.appendChild(div);
            });

            suggestions.classList.remove('hidden');
        } catch (e) {
            hideSuggestions();
        }
    }

    input.addEventListener('input', function () {
        const query = this.value.trim();
        clearCoords();
        clearTimeout(debounceTimer);

        if (query.length < 3) {
            hideSuggestions();
            showStatus('', '');
            return;
        }

        showStatus('Searching...', 'text-gray-400');
        currentQuery = query;
        debounceTimer = setTimeout(() => search(query), 400);
    });

    input.addEventListener('blur', function () {
        setTimeout(hideSuggestions, 150);
    });

    // If coords already set (edit form), show confirmation
    if (latInput.value && lngInput.value) {
        showStatus('✓ Location saved', 'text-green-600');
    }
})();
</script>
