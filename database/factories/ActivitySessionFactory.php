<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use App\Models\ActivitySession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ActivitySession>
 */
class ActivitySessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Create a new user and a new activity for each fake session.
            'user_id' => User::factory(),
            'activity_id' => Activity::factory(),
            // A random day within the last three months.
            'date' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            // Durations in minutes
            'duration' => fake()->numberBetween(5, 180),
            // Notes is optional, so leave it empty about half the time.
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
