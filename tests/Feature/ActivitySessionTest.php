<?php

use App\Models\ActivitySession;
use App\Models\Activity;
use App\Models\User;

test('the sessions list shows only my own sessions', function () {
    // Arrange: one session of mine and one of another user.
    $user = User::factory()->create();
    $mine = ActivitySession::factory()->create(['user_id' => $user->id]);
    $notMine = ActivitySession::factory()->create();

    // Act: open the list, logged in as that user.
    $response = $this->actingAs($user)->get('/sessions');

    // Assert: the list links to my session, but not to the other one.
    $response->assertOk();
    $response->assertSee(route('sessions.show', $mine));
    $response->assertDontSee(route('sessions.show', $notMine));
});

test('the owner can open a session detail page', function () {
    $session = ActivitySession::factory()->create();

    $response = $this->actingAs($session->user)->get(route('sessions.show', $session));

    $response->assertOk();
    $response->assertSee($session->activity->name);
});

test('other users get 403 on a session detail page', function () {
    $session = ActivitySession::factory()->create();
    $otherUser = User::factory()->create();

    $response = $this->actingAs($otherUser)->get(route('sessions.show', $session));

    $response->assertForbidden();
});

test('a logged-in user can create a session that belongs to them', function () {
    // Arrange: a user, and an activity the form can choose.
    $user = User::factory()->create();
    $activity = Activity::factory()->create();

    // Act: send the form as that user, the way the browser does.
    $response = $this->actingAs($user)->post(route('sessions.store'), [
        'activity_id' => $activity->id,
        'date' => '2026-10-01',
        'duration' => 45,
        'notes' => 'Easy pace',
    ]);

    // Assert: the session is saved for this user, and the browser is sent to its detail page.
    $this->assertDatabaseHas('activity_sessions', [
        'user_id' => $user->id,
        'activity_id' => $activity->id,
        'date' => '2026-10-01',
        'duration' => 45,
    ]);
    $response->assertRedirect(route('sessions.show', ActivitySession::first()));
});

test('invalid input is refused with error messages', function () {
    // Arrange: a logged-in user.
    $user = User::factory()->create();

    // Act: send the form with empty required fields, coming from the create page.
    $response = $this->actingAs($user)
        ->from(route('sessions.create'))
        ->post(route('sessions.store'), [
            'activity_id' => '',
            'date' => '',
            'duration' => '',
        ]);

    // Assert: back to the form, an error for each required field, and nothing saved.
    $response->assertRedirect(route('sessions.create'));
    $response->assertSessionHasErrors(['activity_id', 'date', 'duration']);
    $this->assertDatabaseCount('activity_sessions', 0);
});