<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use League\CommonMark\CommonMarkConverter;

class CvController extends Controller
{
    public function saved()
    {
        $user    = Auth::user();
        $profile = $user->profile;

        if (!$profile?->cv_content) {
            return redirect('/cv/generate')->with('info', 'You have no saved CV yet. Generate one first.');
        }

        $cv = $profile->cv_content;
        $cv = preg_replace('/^```(?:markdown)?\s*/i', '', trim($cv));
        $cv = preg_replace('/\s*```$/', '', $cv);
        $cv = trim($cv);

        $converter = new CommonMarkConverter();
        $cvHtml = $converter->convert($cv)->getContent();

        return view('cv.result', compact('cv', 'cvHtml', 'user'));
    }

    public function deleteSaved()
    {
        $user = Auth::user();
        $user->profile?->update(['cv_content' => null, 'cv_generated_at' => null]);

        return redirect('/profile')->with('success', 'Saved CV deleted.');
    }

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

        $prompt = "Create a complete, {$request->tone} CV in markdown for {$user->full_name} applying for the role of {$request->job_title}.

Candidate info:
- Location: {$location}
- Bio/About: {$bio}
- Skills: {$skills}
- Education: {$education}

Instructions:
- Use the candidate's info as the foundation and expand it professionally.
- Generate ALL of these sections (use ## for section headers):
  ## Professional Summary
  ## Skills
  ## Work Experience (if no real experience, write \"Open to first opportunities\" with 2-3 relevant internship/junior-level bullet points they could pursue)
  ## Education
  ## Additional Information (languages, interests, soft skills — infer from context)
- Under ## Skills, list skills as a comma-separated line, not a bullet list.
- Make the summary 3-4 sentences: who they are, what they bring, what they're looking for.
- Be specific, modern, and ATS-friendly. Do NOT add a name header at the top.";

        $apiKey = config('services.gemini.key');

        if (!$apiKey) {
            return back()->with('error', 'Gemini API key not configured. Add GEMINI_API_KEY to your .env file.');
        }

        $response = Http::timeout(30)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "You are a professional CV writer. Write clear, modern, ATS-friendly CVs in markdown.\n\n" . $prompt],
                        ],
                    ],
                ],
                'generationConfig' => [
                    'maxOutputTokens' => 1024,
                    'temperature'     => 0.7,
                ],
            ]);

        if ($response->failed()) {
            $msg = $response->json('error.message', 'Unknown error');
            return back()->with('error', "AI error: {$msg}");
        }

        $cv = $response->json('candidates.0.content.parts.0.text');

        if (!$cv) {
            return back()->with('error', 'No response from AI. Try again.');
        }

        $cv = preg_replace('/^```(?:markdown)?\s*/i', '', trim($cv));
        $cv = preg_replace('/\s*```$/', '', $cv);
        $cv = trim($cv);

        $profile = $user->profile ?? \App\Models\Profile::create(['user_id' => $user->id]);
        $profile->update([
            'cv_content'      => $cv,
            'cv_generated_at' => now(),
        ]);

        $converter = new CommonMarkConverter();
        $cvHtml = $converter->convert($cv)->getContent();

        return view('cv.result', compact('cv', 'cvHtml', 'user'));
    }
}
