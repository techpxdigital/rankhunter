<?php

namespace App\Http\Controllers\Headhunter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    public function create()
    {
        return Inertia::render('Headhunter/Jobs/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric',
        ]);

        $request->user()->jobs()->create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'type' => $request->type,
            'salary' => $request->salary,
        ]);

        return back()->with('success', 'Vaga criada com sucesso.');
    }
}
