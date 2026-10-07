<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\ActivitySession;
use Illuminate\Http\Request;

class ActivitySessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only the logged-in user's sessions, newest date first, each with its activity.
        $sessions = auth()->user()->activitySessions()
            ->with('activity')
            ->latest('date')
            ->get();

            return view('userzone.sessions.index', ['sessions' => $sessions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivitySession $session)
    {
        // Only the owner may see a session's details. Everyone else gets "403 Forbidden".
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        return view('userzone.sessions.show', ['session' => $session]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
