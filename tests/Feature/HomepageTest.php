<?php

use App\Models\ActivitySession;

test('the homepage shows recent community sessions', function () {
    // Arrange: one session in the empty test database. The factory also creates its user and activity.
    $session = ActivitySession::factory()->create();

    // Act: open the homepage as a guest.
    $response = $this->get('/');

    // Assert: the page loads and shows the session's activity.
    $response->assertOk();
    $response->assertSee($session->activity->name);
});