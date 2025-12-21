<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfileStat;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => 'password',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'afif@example.com'],
            [
                'name' => 'Afif',
                'password' => 'password',
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );
        UserProfileStat::create(
            ['user_id' => 2],
        );

        $this->call([
            CategorySeeder::class,
            HabitSeeder::class,
            HabitLogSeeder::class
        ]);
    }
}
