<?php

use App\Http\Controllers\Userzone\ActivityController;
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
    // Receives the form from /sessions/create. Same address as the list, but POST instead of GET.
    Route::post('/sessions', [ActivitySessionController::class, 'store'])->name('sessions.store');
    Route::get('/sessions/{session}', [ActivitySessionController::class, 'show'])->name('sessions.show');
    // The form for changing one of your sessions.
    Route::get('/sessions/{session}/edit', [ActivitySessionController::class, 'edit'])->name('sessions.edit');
    // Receives the edit form. Same address as the detail page, but PATCH instead of GET.
    Route::patch('/sessions/{session}', [ActivitySessionController::class, 'update'])->name('sessions.update');
    // Deletes one of your sessions. Same address as the detail page, but DELETE.
    Route::delete('/sessions/{session}', [ActivitySessionController::class, 'destroy'])->name('sessions.destroy');    

    // For the user's profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // The list of all activities. They are shared, so every logged-in user sees the same list.
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    // The form for a new activity.
    Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
    // Receives the form from /activities/create. Same address as the list, but POST instead of GET.
    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
});
