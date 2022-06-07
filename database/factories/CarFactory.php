<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Car::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'model' => $this->faker->word,
            'year' => $this->faker->biasedNumberBetween(1000,2022),
            'category_id' => Category::get()->random()->id
        ];
    }
}
