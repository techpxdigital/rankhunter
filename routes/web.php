<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicRegisterController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Headhunter\JobController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Página Pública
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/*
|--------------------------------------------------------------------------
| Registro via Token
|--------------------------------------------------------------------------
*/

Route::get('/r/{token}', [PublicRegisterController::class, 'create'])
    ->name('public.register');

Route::post('/r/{token}', [PublicRegisterController::class, 'store'])
    ->name('public.register.store');

/*
|--------------------------------------------------------------------------
| Rotas Autenticadas Gerais
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Headhunter
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:headhunter'])->prefix('headhunter')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Headhunter/Dashboard');
    })->name('headhunter.dashboard');

    Route::get('/jobs/create', [JobController::class, 'create'])
        ->name('headhunter.jobs.create');

    Route::post('/jobs', [JobController::class, 'store'])
        ->name('headhunter.jobs.store');
});

/*
|--------------------------------------------------------------------------
| Candidate
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:candidate'])
    ->prefix('candidate')
    ->group(function () {

        // Tela para completar perfil (SEM candidate.complete)
        Route::get('/complete-profile', [CandidateController::class, 'complete'])
            ->name('candidate.complete-profile');

        Route::post('/complete-profile', [CandidateController::class, 'storeComplete'])
            ->name('candidate.complete-profile.store');

        // Rotas protegidas que exigem perfil completo
        Route::middleware('candidate.complete')->group(function () {

            Route::get('/dashboard', function () {
                return Inertia::render('Candidate/Dashboard');
            })->name('candidate.dashboard');

        });
    });


require __DIR__.'/auth.php';
