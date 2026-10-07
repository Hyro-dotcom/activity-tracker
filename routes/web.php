<?php

use App\Http\Controllers\Userzone\ActivitySessionController;
use App\Http\Controllers\Userzone\DashboardController;
use App\Http\Controllers\Userzone\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
 * Public Website routes
 */
Route::get('/', WelcomeController::class)->name('welcome');

// Todo: add your public routes here

/*
 * Authentication routes
 */
require __DIR__.'/auth.php';


/*
 * Userzone routes
 */
Route::middleware('auth')->group(function () {
    // For the user's dashboard (after login)
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // The logged-in user's own sessions
    Route::get('/sessions', [ActivitySessionController::class, 'index'])->name('sessions.index');
    // The form for a new session. It must stay above /sessions/{session},
    // or {session} would take the word "create" as a session id.
    Route::get('/sessions/create', [ActivitySessionController::class, 'create'])->name('sessions.create');
    Route::get('/sessions/{session}', [ActivitySessionController::class, 'show'])->name('sessions.show');

    // For the user's profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
