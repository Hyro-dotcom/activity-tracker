<?php

use App\Models\Activity;
use App\Models\ActivitySession;

// A session points at one activity through its activity_id (belongsTo).
test('a session belongs to its activity', function () {
    // Arrange: an activity we know, and a session that points at it.
    $activity = Activity::factory()->create();
    $session = ActivitySession::factory()->create(['activity_id' => $activity->id]);

    // Act and assert: asking the session for its activity gives back that same activity.
    expect($session->activity->id)->toBe($activity->id);
});

// An activity collects all sessions that point at it (hasMany).
test('an activity has many sessions', function () {
    // Arrange: one activity with three sessions, plus one session of another activity.
    $activity = Activity::factory()->create();
    ActivitySession::factory()->count(3)->create(['activity_id' => $activity->id]);
    ActivitySession::factory()->create();

    // Act and assert: the activity finds exactly its own three sessions.
    expect($activity->activitySessions)->toHaveCount(3);
});