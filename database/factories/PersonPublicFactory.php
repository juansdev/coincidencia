<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Location;
use App\Models\Municipality;
use App\Models\PersonPublic;
use App\Models\TypePerson;
use App\Models\TypePosition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PersonPublic>
 */
class PersonPublicFactory extends Factory
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
            'municipality_id' => function () {
                return Municipality::factory()->create()->id;
            },
            'location_id' => function () {
                return Location::factory()->create()->id;
            },
            'type_person_id' => function () {
                return TypePerson::factory()->create()->id;
            },
            'type_position_id' => function () {
                return TypePosition::factory()->create()->id;
            },
            'name' => $this->faker->unique()->name,
            'active_years' => $this->faker->randomNumber(),
        ];
    }
}
