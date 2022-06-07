<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Category;
use App\Models\Driver;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(20)->create();
        $drivers = Driver::factory(50)->create();
        $cars = Car::factory(200)->create();

        foreach ($cars as $car){
            $driversIds = $drivers->random(5)->pluck('id');

            $car->drivers()->attach($driversIds);
        }
        // \App\Models\User::factory(10)->create();
    }
}
