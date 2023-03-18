<?php

namespace Database\Factories;

use App\Models\TypePosition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TypePosition>
 */
class TypePositionFactory extends Factory
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
