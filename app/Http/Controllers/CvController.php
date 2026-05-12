<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CvController extends Controller
{
    public function form()
    {
        $user    = Auth::user();
        $profile = $user->profile ?? new \App\Models\Profile();
        return view('cv.generate', compact('user', 'profile'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'job_title' => ['required', 'max:100'],
            'tone'      => ['required', 'in:professional,creative,concise'],
        ]);

        $user    = Auth::user();
        $profile = $user->profile;

        $skills    = $profile?->skills    ?? $request->input('skills', '');
        $education = $profile?->education ?? $request->input('education', '');
        $bio       = $profile?->bio       ?? $request->input('bio', '');
        $location  = $profile?->location  ?? '';

        $prompt = "Write a {$request->tone} CV for {$user->full_name}.
Target job: {$request->job_title}.
Location: {$location}.
Summary/Bio: {$bio}.
Skills: {$skills}.
Education: {$education}.

Format in markdown with sections: ## Summary, ## Skills, ## Education. Be concise and impactful. Only use the provided information, do not invent details.";

        $apiKey = config('services.groq.key');

        if (!$apiKey) {
            return back()->with('error', 'Groq API key not configured. Add GROQ_API_KEY to your .env file.');
        }

        $response = Http::withToken($apiKey)
            ->timeout(30)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'      => 'llama-3.1-8b-instant',
                'max_tokens' => 1024,
                'messages'   => [
                    ['role' => 'system', 'content' => 'You are a professional CV writer. Write clear, modern, ATS-friendly CVs in markdown.'],
                    ['role' => 'user',   'content' => $prompt],
                ],
            ]);

        if ($response->failed()) {
            $msg = $response->json('error.message', 'Unknown error');
            return back()->with('error', "AI error: {$msg}");
        }

        $cv = $response->json('choices.0.message.content');

        if (!$cv) {
            return back()->with('error', 'No response from AI. Try again.');
        }

        return view('cv.result', compact('cv', 'user'));
    }
}
