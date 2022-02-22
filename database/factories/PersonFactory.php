<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'birth_date' => $this->faker->date(),
        ];
    }
}
