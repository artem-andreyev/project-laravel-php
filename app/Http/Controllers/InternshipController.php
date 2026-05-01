<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Application;
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

        $internships = $query->simplePaginate(6);

        return view('internships.index', [
            'internships' => $internships,
        ]);
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('internships.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'title'        => ['required', 'min:3'],
            'duration'     => ['required'],
            'description'  => ['nullable', 'max:5000'],
            'location'     => ['nullable', 'max:100'],
            'requirements' => ['nullable', 'max:5000'],
        ]);

        $user = Auth::user();
        $employer = $user->employer ?? \App\Models\Employer::inRandomOrder()->first()
            ?? \App\Models\Employer::factory()->create();

        Internship::create([
            'title'        => $validated['title'],
            'duration'     => $validated['duration'],
            'description'  => $validated['description'] ?? null,
            'location'     => $validated['location'] ?? 'Rīga',
            'requirements' => $validated['requirements'] ?? null,
            'employer_id'  => $employer->id,
        ]);

        return redirect('/internships')->with('success', 'Internship posted successfully!');
    }

    public function show(Internship $internship)
    {
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = Application::where('user_id', Auth::id())
                ->where('listing_type', 'internship')
                ->where('listing_id', $internship->id)
                ->exists();
        }

        return view('internships.show', [
            'internship' => $internship,
            'hasApplied' => $hasApplied,
        ]);
    }

    public function edit(Internship $internship)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $isOwner = $user->employer && $user->employer->id === $internship->employer_id;

        if (!$user->isAdmin() && !$isOwner) {
            abort(403, 'You do not have permission to edit this internship.');
        }

        return view('internships.edit', ['internship' => $internship]);
    }

    public function update(Request $request, Internship $internship)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $isOwner = $user->employer && $user->employer->id === $internship->employer_id;

        if (!$user->isAdmin() && !$isOwner) {
            abort(403, 'You do not have permission to update this internship.');
        }

        $validated = $request->validate([
            'title'        => ['required', 'min:3'],
            'duration'     => ['required'],
            'description'  => ['nullable', 'max:5000'],
            'location'     => ['nullable', 'max:100'],
            'requirements' => ['nullable', 'max:5000'],
        ]);

        $internship->update($validated);

        return redirect('/internships/' . $internship->id)->with('success', 'Internship updated successfully!');
    }

    public function destroy(Internship $internship)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $isOwner = $user->employer && $user->employer->id === $internship->employer_id;

        if (!$user->isAdmin() && !$isOwner) {
            abort(403, 'You do not have permission to delete this internship.');
        }

        $internship->delete();

        return redirect('/internships')->with('success', 'Internship deleted.');
    }
}
