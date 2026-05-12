<?php

namespace App\Http\Controllers;

use App\Models\SavedListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedListingController extends Controller
{
    public function index()
    {
        $saved = Auth::user()->savedListings()->latest()->get();
        return view('saved.index', compact('saved'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'listing_type' => ['required', 'in:job,internship'],
            'listing_id'   => ['required', 'integer'],
        ]);

        $user = Auth::user();
        $existing = $user->savedListings()
            ->where('listing_type', $request->listing_type)
            ->where('listing_id', $request->listing_id)
            ->first();

        if ($existing) {
            $existing->delete();
            $saved = false;
        } else {
            SavedListing::create([
                'user_id'      => $user->id,
                'listing_type' => $request->listing_type,
                'listing_id'   => $request->listing_id,
            ]);
            $saved = true;
        }

        if ($request->wantsJson()) {
            return response()->json(['saved' => $saved]);
        }

        return back()->with('success', $saved ? 'Saved!' : 'Removed from saved.');
    }
}
