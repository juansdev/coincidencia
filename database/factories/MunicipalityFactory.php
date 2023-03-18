<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Municipality>
 */
class MunicipalityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => function () {
                return Department::factory()->create()->id;
            },
            'name' => $this->faker->city
        ];
    }
}
