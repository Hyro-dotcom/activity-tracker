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
}
