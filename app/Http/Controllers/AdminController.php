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
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'in:student,employer,admin'],
        ]);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Role updated.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function jobs()
    {
        $jobs = Job::with('employer')->latest()->paginate(15);
        return view('admin.jobs', compact('jobs'));
    }

    public function deleteJob(Job $job)
    {
        $job->delete();
        return back()->with('success', 'Job deleted.');
    }
}
