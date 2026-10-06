<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ActivitySession;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Fixed admin account for logging in (required by the assignment).
        // The User model hashes the password automatically (see casts() in User.php).
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        // A few more users, so the data comes from different people.
        User::factory(4)->create();

        // The fixed list of activities everyone can choose from.
        $activityNames = ['Full-Body-Workout', '5k Run', '10k Run', 'Group Run', 'Beach Volleyball', 'Badminton', 'Sauna', 'Hyrox Course'];

        // Create each activity exactly once, so the form will show no duplicates.
        foreach ($activityNames as $name) {
            Activity::factory()->create(['name' => $name]);
        }
        
        // Sessions that reuse the users and activities created above,
        // instead of creating new ones for every session.
        ActivitySession::factory(30)
            ->recycle(User::all())
            ->recycle(Activity::all())
            ->create();
    }
}
