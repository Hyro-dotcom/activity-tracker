<?php

use App\Models\ActivitySession;
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