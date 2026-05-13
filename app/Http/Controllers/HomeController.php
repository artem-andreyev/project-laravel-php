<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Internship;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'jobs'        => Job::count(),
            'internships' => Internship::count(),
            'employers'   => User::where('role', 'employer')->count(),
        ];

        $latestJobs = Job::with('employer')->latest()->take(3)->get();

        return view('home', compact('stats', 'latestJobs'));
    }
}
