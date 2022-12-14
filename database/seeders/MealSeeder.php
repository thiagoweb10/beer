<?php

namespace Database\Seeders;

use App\Models\Meal;
use Database\Factories\MealFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meal::factory()
        ->count(10)
        ->create();
    }
}
