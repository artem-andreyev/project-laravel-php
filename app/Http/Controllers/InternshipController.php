<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Application;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Internship::with('employer')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('duration', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        if ($request->filled('duration')) {
            $query->where('duration', $request->input('duration'));
        }

        return view('internships.index', ['internships' => $query->simplePaginate(6)]);
    }

    public function create()
    {
        return view('internships.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => ['required', 'min:3'],
            'duration'     => ['required'],
            'description'  => ['nullable', 'max:5000'],
            'location'     => ['nullable', 'max:255'],
            'latitude'     => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'    => ['nullable', 'numeric', 'between:-180,180'],
            'requirements' => ['nullable', 'max:5000'],
        ]);

        $user = Auth::user();
        $employer = $user->employer ?? Employer::inRandomOrder()->first() ?? Employer::factory()->create();

        Internship::create(array_merge($validated, ['employer_id' => $employer->id]));

        return redirect('/internships')->with('success', 'Internship posted successfully!');
    }

    public function show(Internship $internship)
    {
        $hasApplied = Auth::check() && Application::where('user_id', Auth::id())
            ->where('listing_type', 'internship')
            ->where('listing_id', $internship->id)
            ->exists();

        return view('internships.show', compact('internship', 'hasApplied'));
    }

    public function edit(Internship $internship)
    {
        $this->authorizeOwner($internship->employer_id);
        return view('internships.edit', compact('internship'));
    }

    public function update(Request $request, Internship $internship)
    {
        $this->authorizeOwner($internship->employer_id);

        $validated = $request->validate([
            'title'        => ['required', 'min:3'],
            'duration'     => ['required'],
            'description'  => ['nullable', 'max:5000'],
            'location'     => ['nullable', 'max:255'],
            'latitude'     => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'    => ['nullable', 'numeric', 'between:-180,180'],
            'requirements' => ['nullable', 'max:5000'],
        ]);

        $internship->update($validated);

        return redirect('/internships/' . $internship->id)->with('success', 'Internship updated!');
    }

    public function destroy(Internship $internship)
    {
        $this->authorizeOwner($internship->employer_id);
        $internship->delete();
        return redirect('/internships')->with('success', 'Internship deleted.');
    }

    private function authorizeOwner(int $employerId): void
    {
        $user = Auth::user();
        $isOwner = $user->employer && $user->employer->id === $employerId;
        if (!$user->isAdmin() && !$isOwner) {
            abort(403);
        }
    }
}
