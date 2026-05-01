<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Auth::user()->applications()->latest()->get();
        return view('applications.index', compact('applications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'listing_type' => ['required', 'in:job,internship'],
            'listing_id'   => ['required', 'integer'],
            'cover_letter' => ['nullable', 'max:2000'],
        ]);

        $exists = Application::where('user_id', Auth::id())
            ->where('listing_type', $request->listing_type)
            ->where('listing_id', $request->listing_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already applied for this position.');
        }

        Application::create([
            'user_id'      => Auth::id(),
            'listing_type' => $request->listing_type,
            'listing_id'   => $request->listing_id,
            'cover_letter' => $request->cover_letter,
            'status'       => 'pending',
            'applied_at'   => now(),
        ]);

        $route = $request->listing_type === 'job' ? '/jobs/' : '/internships/';
        return redirect($route . $request->listing_id)->with('success', 'Application submitted successfully!');
    }

    public function destroy(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }
        $application->delete();
        return redirect('/applications')->with('success', 'Application withdrawn.');
    }

    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => ['required', 'in:pending,reviewed,accepted,rejected'],
        ]);
        $application->update(['status' => $request->status]);
        return back()->with('success', 'Status updated.');
    }
}
