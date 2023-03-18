<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'municipality_id' => function () {
                return Municipality::factory()->create()->id;
            },
            'name' => $this->faker->city
        ];
    }
}
