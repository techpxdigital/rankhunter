<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PublicRegisterController extends Controller
{
    public function create($token)
    {
        $headhunter = User::where('referral_token', $token)
            ->where('role', 'headhunter')
            ->firstOrFail();

        return Inertia::render('Auth/PublicRegister', [
            'headhunter' => [
                'name' => $headhunter->name,
            ],
            'token' => $token,
        ]);
    }

    public function store(Request $request, $token)
    {
        $headhunter = User::where('referral_token', $token)
            ->where('role', 'headhunter')
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'candidate',
        ]);

        Candidate::create([
            'user_id' => $user->id,
            'headhunter_id' => $headhunter->id,
        ]);

        Auth::login($user);

        return redirect()->route('candidate.complete-profile');
    }
}
