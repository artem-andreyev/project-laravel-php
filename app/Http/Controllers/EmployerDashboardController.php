<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\Internship;
use App\Mail\ApplicationStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmployerDashboardController extends Controller
{
    public function index()
    {
        $user     = Auth::user();
        $employer = $user->employer;

        if (!$employer) {
            return redirect('/employer/create')->with('error', 'Set up your employer profile first.');
        }

        $jobs        = $employer->jobs()->withCount('applications')->latest()->get();
        $internships = $employer->internships()->withCount('applications')->latest()->get();

        $allListingIds   = $jobs->pluck('id');
        $allInternIds    = $internships->pluck('id');

        $recentApplications = Application::where(function ($q) use ($allListingIds, $allInternIds) {
            $q->where(function ($q2) use ($allListingIds) {
                $q2->where('listing_type', 'job')->whereIn('listing_id', $allListingIds);
            })->orWhere(function ($q2) use ($allInternIds) {
                $q2->where('listing_type', 'internship')->whereIn('listing_id', $allInternIds);
            });
        })->with('user')->latest()->take(10)->get();

        $stats = [
            'jobs'         => $jobs->count(),
            'internships'  => $internships->count(),
            'applications' => $recentApplications->count(),
            'pending'      => $recentApplications->where('status', 'pending')->count(),
        ];

        return view('employer.dashboard', compact('employer', 'jobs', 'internships', 'recentApplications', 'stats'));
    }

    public function applications(Request $request)
    {
        $user     = Auth::user();
        $employer = $user->employer;

        if (!$employer) {
            return redirect('/employer/create');
        }

        $jobIds   = $employer->jobs()->pluck('id');
        $internIds = $employer->internships()->pluck('id');

        $query = Application::where(function ($q) use ($jobIds, $internIds) {
            $q->where(function ($q2) use ($jobIds) {
                $q2->where('listing_type', 'job')->whereIn('listing_id', $jobIds);
            })->orWhere(function ($q2) use ($internIds) {
                $q2->where('listing_type', 'internship')->whereIn('listing_id', $internIds);
            });
        })->with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate(20);

        return view('employer.applications', compact('applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $request->validate(['status' => ['required', 'in:pending,reviewed,accepted,rejected']]);

        $user     = Auth::user();
        $employer = $user->employer;

        $jobIds   = $employer->jobs()->pluck('id');
        $internIds = $employer->internships()->pluck('id');

        $owns = ($application->listing_type === 'job' && $jobIds->contains($application->listing_id))
             || ($application->listing_type === 'internship' && $internIds->contains($application->listing_id));

        if (!$owns && !$user->isAdmin()) {
            abort(403);
        }

        $oldStatus = $application->status;
        $newStatus = $request->status;

        $application->update(['status' => $newStatus]);

        $listing = $application->getListing();
        $listingTitle = $listing?->title ?? 'Unknown position';

        if (in_array($newStatus, ['accepted', 'rejected']) && $oldStatus !== $newStatus) {
            try {
                Mail::to($application->user->email)
                    ->send(new ApplicationStatusChanged($application, $listingTitle));
            } catch (\Exception $e) {
            }
        }

        if ($newStatus === 'accepted' && $listing) {
            $listing->update(['is_closed' => true]);

            Application::where('listing_type', $application->listing_type)
                ->where('listing_id', $application->listing_id)
                ->where('id', '!=', $application->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);
        }

        return back()->with('success', 'Status updated.');
    }
}
