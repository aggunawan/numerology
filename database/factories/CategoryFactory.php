<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => ucwords($this->faker->words(2, true)),
            'year_formula' => '=YYYY',
        ];
    }
}
