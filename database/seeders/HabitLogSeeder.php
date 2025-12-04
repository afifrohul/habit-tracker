<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logs = [
            [
                'user_id' => 2,
                'habit_id' => 1,
                'exp_gain' => 10,
                'date' => now()->format('Y-m-d'),
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'habit_id' => 2,
                'exp_gain' => 10,
                'date' => now()->format('Y-m-d'),
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'habit_id' => 3,
                'exp_gain' => 10,
                'date' => now()->format('Y-m-d'),
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'habit_id' => 4,
                'exp_gain' => 10,
                'date' => now()->format('Y-m-d'),
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'habit_id' => 5,
                'exp_gain' => 10,
                'date' => now()->format('Y-m-d'),
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'habit_id' => 6,
                'exp_gain' => 10,
                'date' => now()->format('Y-m-d'),
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ];

        foreach ($logs as $item) {
            \App\Models\HabitLog::create($item);
        }
    }
}
