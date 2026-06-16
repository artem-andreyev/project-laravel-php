<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        $applications = $user->applications()->latest()->take(5)->get();
        return view('profile.show', compact('user', 'profile', 'applications'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);
        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'max:100'],
            'last_name'  => ['required', 'max:100'],
            'phone'      => ['nullable', 'max:20'],
            'bio'        => ['nullable', 'max:1000'],
            'skills'     => ['nullable', 'max:500'],
            'education'  => ['nullable', 'max:300'],
            'location'   => ['nullable', 'max:100'],
            'website'    => ['nullable', 'url', 'max:200'],
        ]);

        $user = Auth::user();
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
        ]);

        $profileData = [
            'user_id'   => $user->id,
            'phone'     => $validated['phone'] ?? null,
            'bio'       => $validated['bio'] ?? null,
            'skills'    => $validated['skills'] ?? null,
            'education' => $validated['education'] ?? null,
            'location'  => $validated['location'] ?? null,
            'website'   => $validated['website'] ?? null,
        ];

        if ($request->hasFile('cv')) {
            $filename = $request->file('cv')->getClientOriginalName();
            $path = $request->file('cv')->storeAs('cvs', $filename, 'public');
            $profileData['cv_path'] = $path;
        }

        Profile::updateOrCreate(['user_id' => $user->id], $profileData);

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }

    public function showPublic(User $user)
    {
        $profile = $user->profile ?? new Profile();

        $cvHtml = null;
        if ($profile->cv_content) {
            $cv = preg_replace('/^```(?:markdown)?\s*/i', '', trim($profile->cv_content));
            $cv = preg_replace('/\s*```$/', '', $cv);
            $converter = new \League\CommonMark\CommonMarkConverter();
            $cvHtml = $converter->convert(trim($cv))->getContent();
        }

        return view('profile.public', compact('user', 'profile', 'cvHtml'));
    }

    public function downloadUserCv(User $user)
    {
        $profile = $user->profile;

        if (!$profile || !$profile->cv_path) {
            abort(404);
        }

        if (!Storage::disk('public')->exists($profile->cv_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($profile->cv_path);
    }

    public function downloadCv()
    {
        $profile = Auth::user()->profile;

        if (!$profile || !$profile->cv_path) {
            abort(404);
        }

        if (!Storage::disk('public')->exists($profile->cv_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($profile->cv_path);
    }
}
