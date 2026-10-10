<?php

use App\Models\Activity;
use App\Models\User;

test('logged-in users see all activities', function () {
    // Arrange: a user and two activities with known names.
    $user = User::factory()->create();
    Activity::factory()->create(['name' => 'Sauna']);
    Activity::factory()->create(['name' => 'Badminton']);

    // Act: open the activity list.
    $response = $this->actingAs($user)->get(route('activities.index'));

    // Assert: both names are on the page.
    $response->assertSee('Sauna');
    $response->assertSee('Badminton');
});

test('a logged-in user can add an activity', function () {
    // Arrange: a logged-in user.
    $user = User::factory()->create();

    // Act: send the form with a new activity.
    $response = $this->actingAs($user)->post(route('activities.store'), [
        'name' => 'Climbing',
        'description' => 'Indoor bouldering',
    ]);

    // Assert: the row exists, and the browser goes back to the list.
    $this->assertDatabaseHas('activities', ['name' => 'Climbing', 'description' => 'Indoor bouldering']);
    $response->assertRedirect(route('activities.index'));
});

test('an activity name must be unique', function () {
    // Arrange: an activity that already exists.
    $user = User::factory()->create();
    Activity::factory()->create(['name' => '5k Run']);

    // Act: try to add the same name again, from the form.
    $response = $this->actingAs($user)
        ->from(route('activities.create'))
        ->post(route('activities.store'), ['name' => '5k Run']);

    // Assert: back to the form with an error, and still only one activity.
    $response->assertRedirect(route('activities.create'));
    $response->assertSessionHasErrors('name');
    $this->assertDatabaseCount('activities', 1);
});