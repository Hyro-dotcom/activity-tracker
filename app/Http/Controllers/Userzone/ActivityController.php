<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        // All activities, sorted by name. No user filter: activities are shared by everyone.
        $activities = Activity::orderBy('name')->get();

        return view('userzone.activities.index', ['activities' => $activities]);
    }

        public function create()
    {
        // Only shows the form. It needs no data, because there is no drop-down.
        return view('userzone.activities.create');
    }

        public function store(Request $request)
    {
        // Check every field before anything is saved. The limits are your decisions.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:activities,name'],
            'description' => ['nullable', 'string', 'max:140'],
        ]);

        // Save the new activity. $fillable allows exactly these two fields.
        Activity::create($validated);

        // Back to the list, where the new activity appears in its sorted place.
        return redirect()->route('activities.index');
    }
}
