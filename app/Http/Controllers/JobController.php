<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('employer')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('salary', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->input('job_type'));
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        $jobs = $query->simplePaginate(6);

        return view('jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'title'        => ['required', 'min:3'],
            'salary'       => ['required'],
            'description'  => ['nullable', 'max:5000'],
            'location'     => ['nullable', 'max:100'],
            'job_type'     => ['nullable', 'in:full-time,part-time,remote,internship'],
            'industry'     => ['nullable', 'max:100'],
            'requirements' => ['nullable', 'max:5000'],
        ]);

        $user = Auth::user();
        $employer = $user->employer ?? \App\Models\Employer::inRandomOrder()->first()
            ?? \App\Models\Employer::factory()->create();

        Job::create([
            'title'        => $validated['title'],
            'salary'       => $validated['salary'],
            'description'  => $validated['description'] ?? null,
            'location'     => $validated['location'] ?? 'Rīga',
            'job_type'     => $validated['job_type'] ?? 'full-time',
            'industry'     => $validated['industry'] ?? null,
            'requirements' => $validated['requirements'] ?? null,
            'employer_id'  => $employer->id,
        ]);

        return redirect('/jobs')->with('success', 'Job posted successfully!');
    }

    public function show(Job $job)
    {
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = Application::where('user_id', Auth::id())
                ->where('listing_type', 'job')
                ->where('listing_id', $job->id)
                ->exists();
        }

        return view('jobs.show', [
            'job'        => $job,
            'hasApplied' => $hasApplied,
        ]);
    }

    public function edit(Job $job)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $isOwner = $user->employer && $user->employer->id === $job->employer_id;

        if (!$user->isAdmin() && !$isOwner) {
            abort(403, 'You do not have permission to edit this job.');
        }

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, Job $job)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $isOwner = $user->employer && $user->employer->id === $job->employer_id;

        if (!$user->isAdmin() && !$isOwner) {
            abort(403, 'You do not have permission to update this job.');
        }

        $validated = $request->validate([
            'title'        => ['required', 'min:3'],
            'salary'       => ['required'],
            'description'  => ['nullable', 'max:5000'],
            'location'     => ['nullable', 'max:100'],
            'job_type'     => ['nullable', 'in:full-time,part-time,remote,internship'],
            'industry'     => ['nullable', 'max:100'],
            'requirements' => ['nullable', 'max:5000'],
        ]);

        $job->update($validated);

        return redirect('/jobs/' . $job->id)->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $isOwner = $user->employer && $user->employer->id === $job->employer_id;

        if (!$user->isAdmin() && !$isOwner) {
            abort(403, 'You do not have permission to delete this job.');
        }

        $job->delete();

        return redirect('/jobs')->with('success', 'Job deleted.');
    }
}
