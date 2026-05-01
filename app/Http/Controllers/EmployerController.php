<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user->employer) {
            return redirect('/employer/' . $user->employer->id . '/edit')
                ->with('info', 'You already have a company profile. You can edit it here.');
        }

        return view('employers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'max:100'],
            'industry'    => ['nullable', 'max:100'],
            'address'     => ['nullable', 'max:150'],
            'website'     => ['nullable', 'url', 'max:200'],
            'description' => ['nullable', 'max:2000'],
        ]);

        $user = Auth::user();

        if ($user->employer) {
            return redirect('/employer/' . $user->employer->id . '/edit')
                ->with('error', 'You already have a company profile.');
        }

        $employer = Employer::create([
            'user_id'     => $user->id,
            'name'        => $validated['name'],
            'industry'    => $validated['industry'] ?? null,
            'address'     => $validated['address'] ?? null,
            'website'     => $validated['website'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        $user->update(['role' => 'employer']);

        return redirect('/profile')->with('success', 'Company profile created successfully!');
    }

    public function edit(Employer $employer)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $employer->user_id !== $user->id) {
            abort(403, 'You do not have permission to edit this employer profile.');
        }

        return view('employers.edit', compact('employer'));
    }

    public function update(Request $request, Employer $employer)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $employer->user_id !== $user->id) {
            abort(403, 'You do not have permission to update this employer profile.');
        }

        $validated = $request->validate([
            'name'        => ['required', 'max:100'],
            'industry'    => ['nullable', 'max:100'],
            'address'     => ['nullable', 'max:150'],
            'website'     => ['nullable', 'url', 'max:200'],
            'description' => ['nullable', 'max:2000'],
        ]);

        $employer->update($validated);

        return redirect('/profile')->with('success', 'Company profile updated successfully!');
    }
}
