<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Full-Body-Workout', '5k Run', '10k Run', 'Group Run', 'Beach Volleyball', 'Badminton', 'Sauna', 'Hyrox Course']),
            // Description is optional, so leave it empty about half the time.
            'description' => fake()->optional()->sentence(),
        ];
    }
}
