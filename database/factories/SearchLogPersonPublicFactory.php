<?php

namespace Database\Factories;

use App\Models\PersonPublic;
use App\Models\SearchLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SearchLog>
 */
class SearchLogPersonPublicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'percent_match' => $this->faker->randomNumber(),
            'search_log_id' => function () {
                return SearchLog::factory()->create()->id;
            },
            'person_public_id' => function () {
                return PersonPublic::factory()->create()->id;
            },
        ];
    }
}
