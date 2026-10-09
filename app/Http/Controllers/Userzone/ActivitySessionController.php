<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Activity;
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
        // Load all activities, sorted by name, for the form's dropdown list.
        $activities = Activity::orderBy('name')->get();

        return view('userzone.sessions.create', ['activities' => $activities]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check every field before anything is saved. If a rule fails, Laravel sends the
        // browser back to the form with error messages, and the lines below don't run.
        $validated = $request->validate([
            'activity_id' => ['required', 'exists:activities,id'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'duration' => ['required', 'integer', 'min:1', 'max:1440'],
            'notes' => ['nullable', 'string', 'max:140'],
        ]);

        // Save the session for the logged-in user. The relationship fills in user_id.
        $session = auth()->user()->activitySessions()->create($validated);

        // Show the new session's detail page.
        return redirect()->route('sessions.show', $session);
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
    public function edit(ActivitySession $session)
    {
        // Only the owner may edit a session. Everyone else gets "403 Forbidden".
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        // Load all activities, sorted by name, for the form's drop-down list.
        $activities = Activity::orderBy('name')->get();

        return view('userzone.sessions.edit', ['session' => $session, 'activities' => $activities]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivitySession $session)
    {
        // Only the owner may change a session. Everyone else gets "403 Forbidden".
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        // The same rules as in store(): check every field before anything is saved.
        $validated = $request->validate([
            'activity_id' => ['required', 'exists:activities,id'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'duration' => ['required', 'integer', 'min:1', 'max:1440'],
            'notes' => ['nullable', 'string', 'max:140'],
        ]);

        // Save the changes. $fillable allows exactly these four fields.
        $session->update($validated);

        // Show the changed session's detail page.
        return redirect()->route('sessions.show', $session);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivitySession $session)
    {
        // Only the owner may delete a session. Everyone else gets "403 Forbidden".
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        // Remove this session's row from activity_sessions.
        $session->delete();

        // The session is gone, and so is its detail page: back to the list.
        return redirect()->route('sessions.index');
    }
}
