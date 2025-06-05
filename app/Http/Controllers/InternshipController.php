<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InternshipPosted;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Internship::with('employer')->latest();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('duration', 'like', '%' . $search . '%');
            });
        }

        $internships = $query->simplePaginate(3);

        return view('internships.index', [
            'internships' => $internships
        ]);
    }

    public function create()
    {
        return view('internships.create');
    }

    public function show(Internship $internship)
    {
        return view('internships.show', ['internship' => $internship]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:3'],
            'duration' => ['required']
        ]);

        $employer = \App\Models\Employer::inRandomOrder()->first()
            ?? \App\Models\Employer::factory()->create();

        $internship = Internship::create([
            'title' => $validated['title'],
            'duration' => $validated['duration'],
            'employer_id' => $employer->id
        ]);

        Mail::to($internship->employer->user)->queue(
            new InternshipPosted($internship)
        );

        return redirect('/internships');
    }

    public function edit(Internship $internship)
    {
        return view('internships.edit', ['internship' => $internship]);
    }

    public function update(Request $request, Internship $internship)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:3'],
            'duration' => ['required']
        ]);

        $internship->update($validated);

        return redirect('/internships/' . $internship->id);
    }

    public function destroy(Internship $internship)
    {
        $internship->delete();

        return redirect('/internships');
    }
}
