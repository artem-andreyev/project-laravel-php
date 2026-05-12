<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Internship;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users'        => User::count(),
            'jobs'         => Job::count(),
            'internships'  => Internship::count(),
            'applications' => Application::count(),
            'employers'    => User::where('role', 'employer')->count(),
            'students'     => User::where('role', 'student')->count(),
            'job_seekers'  => User::where('role', 'job_seeker')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function users(Request $request)
    {
        $query = User::latest();
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        $users = $query->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate(['role' => ['required', 'in:student,job_seeker,employer,admin']]);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Role updated.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function jobs(Request $request)
    {
        $query = Job::with('employer')->latest();
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $jobs = $query->paginate(20);
        return view('admin.jobs', compact('jobs'));
    }

    public function deleteJob(Job $job)
    {
        $job->delete();
        return back()->with('success', 'Job deleted.');
    }

    public function internships(Request $request)
    {
        $query = Internship::with('employer')->latest();
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $internships = $query->paginate(20);
        return view('admin.internships', compact('internships'));
    }

    public function deleteInternship(Internship $internship)
    {
        $internship->delete();
        return back()->with('success', 'Internship deleted.');
    }

    public function applications(Request $request)
    {
        $applications = Application::with('user')->latest()->paginate(20);
        return view('admin.applications', compact('applications'));
    }
}
