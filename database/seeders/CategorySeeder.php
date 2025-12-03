<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['user_id' => 2, 'name' => 'Health', 'icon' => 'BriefcaseMedical', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'name' => 'Religion', 'icon' => 'SunMoon', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'name' => 'Productivity', 'icon' => 'UserCog', 'created_at' => now(), 'updated_at' => now()]
        ];

        foreach ($categories as $item) {
            \App\Models\Category::create($item);
        }
    }
}
