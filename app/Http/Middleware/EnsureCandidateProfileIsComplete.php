<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureCandidateProfileIsComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role === 'candidate') {
            $candidate = $user->candidate;

            if (!$candidate || !$candidate->profile_completed) {
                if (!$request->routeIs('candidate.complete-profile')) {
                    return redirect()->route('candidate.complete-profile');
                }
            }
        }

        return $next($request);
    }
}
