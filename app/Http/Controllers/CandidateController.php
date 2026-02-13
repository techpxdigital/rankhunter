<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CandidateController extends Controller
{
    public function complete()
    {
        return Inertia::render('Candidate/CompleteProfile');
    }

    public function storeComplete(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'birth_date' => 'required|date',
        ]);

        $candidate = auth()->user()->candidate;

        $candidate->update([
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'profile_completed' => true,
        ]);

        return redirect()->route('candidate.dashboard');
    }
}
