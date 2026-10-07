<?php

namespace App\Http\Controllers;

use App\Models\ActivitySession;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // The 5 most recent sessions (by date), each with its activity loaded.
        $recentSessions = ActivitySession::with('activity')
            ->latest('date')
            ->take(5)
            ->get();

        return view('welcome', ['recentSessions' => $recentSessions]);
    }
}
