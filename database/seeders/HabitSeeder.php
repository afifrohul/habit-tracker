<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $habits = [
            [
                'user_id' => 2, 
                'category_id' => 1, 
                'name' => 'Workout/Exercise', 
                'color' => '#3b82f6',
                'exp' => 10, 
                'icon' => 'Dumbbell', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2, 
                'category_id' => 1, 
                'name' => '200+ Hand Grip', 
                'color' => '#0369a1',
                'exp' => 10, 
                'icon' => 'BicepsFlexed', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2, 
                'category_id' => 2, 
                'name' => 'Quran', 
                'color' => '#16a34a',
                'exp' => 10, 
                'icon' => 'BookOpen', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2, 
                'category_id' => 2, 
                'name' => 'Pray Dhuha', 
                'color' => '#0f766e',
                'exp' => 10, 
                'icon' => 'Clock8', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2, 
                'category_id' => 3, 
                'name' => 'Coding', 
                'color' => '#7c3aed',
                'exp' => 10, 
                'icon' => 'CodeXml', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'user_id' => 2, 
                'category_id' => 3, 
                'name' => 'Duolingo', 
                'color' => '#065f46',
                'exp' => 10, 
                'icon' => 'Languages', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ];

        foreach ($habits as $item) {
            \App\Models\Habit::create($item);
        }
    }
}
