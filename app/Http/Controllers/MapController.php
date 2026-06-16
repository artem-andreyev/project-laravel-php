<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MapController extends Controller
{
    private const LATVIA_CENTER = ['lat' => 56.8796, 'lng' => 24.6032];

    private const LATVIA_LOCATIONS = [
        'Rīga' => ['lat' => 56.9496, 'lng' => 24.1052],
        'Riga' => ['lat' => 56.9496, 'lng' => 24.1052],
        'Daugavpils' => ['lat' => 55.8794, 'lng' => 26.5294],
        'Liepāja' => ['lat' => 56.5041, 'lng' => 20.9766],
        'Jelgava' => ['lat' => 56.6523, 'lng' => 23.7322],
        'Jūrmala' => ['lat' => 56.9689, 'lng' => 23.8578],
        'Ventspils' => ['lat' => 57.3961, 'lng' => 21.5573],
        'Rēzekne' => ['lat' => 55.7414, 'lng' => 27.2181],
        'Valmiera' => ['lat' => 57.5417, 'lng' => 25.4250],
        'Jēkabpils' => ['lat' => 56.4967, 'lng' => 25.8753],
        'Ogre' => ['lat' => 56.8142, 'lng' => 24.5894],
        'Tukums' => ['lat' => 56.9747, 'lng' => 23.1544],
        'Cēsis' => ['lat' => 57.3117, 'lng' => 25.2733],
        'Sigulda' => ['lat' => 57.1500, 'lng' => 24.8467],
        'Bauska' => ['lat' => 56.4067, 'lng' => 24.1486],
        'Salaspils' => ['lat' => 56.7378, 'lng' => 24.3689],
        'Ādaži' => ['lat' => 57.0147, 'lng' => 24.7158],
        'Saldus' => ['lat' => 56.6747, 'lng' => 22.5189],
        'Dobele' => ['lat' => 56.6236, 'lng' => 23.2767],
        'Kuldīga' => ['lat' => 57.0000, 'lng' => 21.9731],
        'Limbaži' => ['lat' => 57.5019, 'lng' => 24.7139],
        'Madona' => ['lat' => 56.7308, 'lng' => 26.1942],
        'Alūksne' => ['lat' => 57.4267, 'lng' => 26.9856],
        'Gulbene' => ['lat' => 57.1592, 'lng' => 26.2831],
        'Balvi' => ['lat' => 56.1914, 'lng' => 27.2758],
        'Preiļi' => ['lat' => 56.3103, 'lng' => 26.7431],
        'Rēzekne' => ['lat' => 56.5100, 'lng' => 27.3330],
        'Ludza' => ['lat' => 56.5561, 'lng' => 27.7406],
        'Aizkraukle' => ['lat' => 56.2756, 'lng' => 25.4286],
        'Jelgava' => ['lat' => 56.6523, 'lng' => 23.7322],
        'Smiltene' => ['lat' => 57.4183, 'lng' => 25.4333],
        'Viesīte' => ['lat' => 56.3522, 'lng' => 25.3314],
        'Varakļāni' => ['lat' => 56.3222, 'lng' => 26.5056],
    ];

    public function index()
    {
        $listings = $this->getListings();
        return view('map.index', compact('listings'));
    }

    public function data()
    {
        $listings = $this->getListings();
        return response()->json(['listings' => $listings]);
    }

    public function geocode(Request $request)
    {
        $address = $request->input('address', '');
        if (!$address) {
            return response()->json(['error' => 'No address provided'], 400);
        }

        $coords = $this->getCoordinates($address);

        if ($coords) {
            return response()->json(['lat' => $coords['lat'], 'lng' => $coords['lng']]);
        }

        return response()->json(['error' => 'Could not geocode address'], 404);
    }

    private function getListings()
    {
        $jobs = Job::select('id', 'title', 'location', 'latitude', 'longitude', 'created_at')
            ->get()
            ->map(function ($job) {
                $location = $job->location ?? 'Rīga';

                if ($job->latitude && $job->longitude) {
                    $coords = ['lat' => (float) $job->latitude, 'lng' => (float) $job->longitude];
                } else {
                    $coords = $this->getCoordinates($location);
                }

                return [
                    'type' => 'job',
                    'id' => $job->id,
                    'title' => $job->title,
                    'location' => $location,
                    'url' => "/jobs/{$job->id}",
                    'coords' => $coords,
                    'date' => $job->created_at->format('Y-m-d'),
                ];
            })->filter(fn($item) => $item['coords'] !== null)->values();

        $internships = Internship::select('id', 'title', 'location', 'latitude', 'longitude', 'created_at')
            ->get()
            ->map(function ($internship) {
                $location = $internship->location ?? 'Rīga';

                if ($internship->latitude && $internship->longitude) {
                    $coords = ['lat' => (float) $internship->latitude, 'lng' => (float) $internship->longitude];
                } else {
                    $coords = $this->getCoordinates($location);
                }

                return [
                    'type' => 'internship',
                    'id' => $internship->id,
                    'title' => $internship->title,
                    'location' => $location,
                    'url' => "/internships/{$internship->id}",
                    'coords' => $coords,
                    'date' => $internship->created_at->format('Y-m-d'),
                ];
            })->filter(fn($item) => $item['coords'] !== null)->values();

        return $jobs->concat($internships);
    }

    private function getCoordinates($location)
    {
        if (!$location) {
            return null;
        }

        $location = trim($location);
        $cacheKey = 'geocode_v2_' . md5($location);

        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return $cached === false ? null : $cached;
        }

        $coords = $this->geocodeNominatim($location);

        if ($coords) {
            Cache::put($cacheKey, $coords, now()->addDays(30));
            return $coords;
        }

        $parts = array_map('trim', explode(',', $location));
        foreach (array_reverse($parts) as $part) {
            foreach (self::LATVIA_LOCATIONS as $city => $fallbackCoords) {
                if (mb_strtolower($city) === mb_strtolower($part)) {
                    Cache::put($cacheKey, $fallbackCoords, now()->addDays(30));
                    return $fallbackCoords;
                }
            }
        }

        Cache::put($cacheKey, false, now()->addDay());
        return null;
    }

    private function geocodeNominatim($address)
    {
        try {
            $query = $address . ', Latvia';

            $context = stream_context_create([
                'http' => [
                    'timeout' => 5,
                    'header' => implode("\r\n", [
                        'User-Agent: LaravelJobMap/1.0 (student project)',
                        'Accept: application/json',
                    ]),
                    'ignore_errors' => true,
                ],
            ]);

            $url = 'https://nominatim.openstreetmap.org/search?format=json&q=' .
                urlencode($query) .
                '&limit=1&countrycodes=lv';

            $response = @file_get_contents($url, false, $context);

            if ($response === false) {
                return null;
            }

            $data = json_decode($response, true);

            if (!empty($data) && isset($data[0]['lat'], $data[0]['lon'])) {
                return [
                    'lat' => (float) $data[0]['lat'],
                    'lng' => (float) $data[0]['lon'],
                ];
            }
        } catch (\Exception $e) {
        }

        return null;
    }
}
