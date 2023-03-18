<?php

namespace Database\Factories;

use App\Models\SearchLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SearchLog>
 */
class SearchLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'searched_name' => $this->faker->name,
            'percentage_match' => $this->faker->randomNumber(),
            'execution_status' => $this->faker->randomElement(["records_found", "no_matches", "system_error"]),
        ];
    }
}
