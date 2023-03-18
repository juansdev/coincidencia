<?php

namespace Database\Factories;

use App\Models\TypePerson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TypePerson>
 */
class TypePersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name
        ];
    }
}
