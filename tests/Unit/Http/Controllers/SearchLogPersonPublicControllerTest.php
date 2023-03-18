<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\PersonPublic;
use App\Models\SearchLog;
use App\Models\SearchLogPersonPublic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchLogPersonPublicControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_a_404_response_when_search_log_is_not_found()
    {
        $response = $this->getJson("/get-person-public-by-search-log?uuid=invalid-uuid}");
        $response->assertStatus(404);
        $response->assertJsonFragment(['message' => 'No se ha encontrado la búsqueda solicitada.']);
    }

    /** @test */
    public function it_returns_a_json_response_with_matches_when_search_log_has_matches()
    {
        $personPublic = PersonPublic::factory()->create(['name' => 'John Doe']);

        $searchLog = SearchLog::factory()->create([
            'searched_name' => 'John',
            'percentage_match' => 80
        ]);

        $searchLogPersonPublic = SearchLogPersonPublic::factory()->create([
            'search_log_id' => $searchLog->id,
            'person_public_id' => $personPublic->id
        ]);

        $response = $this->getJson("/get-person-public-by-search-log?uuid={$searchLog->uuid}");
        $response->assertOk();
        $response->assertJsonFragment([
            'uuid' => $searchLog->uuid,
            'searched_name' => $searchLog->searched_name,
            'percentage_match' => $searchLog->percentage_match,
            'execution_status' => 'records_found',
            'message' => 'Se encontraron 1 resultados.'
        ]);
    }

    /** @test */
    public function it_returns_a_json_response_with_no_matches_when_search_log_has_no_matches()
    {
        // Create a search log with no matches
        $searchLog = SearchLog::factory()->create([
            'uuid' => 'abc123',
            'searched_name' => 'Foo',
            'percentage_match' => 80,
            'execution_status' => 'no_matches',
        ]);

        // Make a request to the endpoint with the UUID of the search log
        $response = $this->getJson("/get-person-public-by-search-log?uuid={$searchLog->uuid}");

        // Assert that the response has the correct status code
        $response->assertStatus(200);

        // Assert that the response has the correct JSON structure and values
        $response->assertJson([
            'uuid' => 'abc123',
            'searched_name' => 'Foo',
            'percentage_match' => 80,
            'execution_status' => 'no_matches',
            'matches' => [],
            'message' => 'No se han encontrado resultados para tu búsqueda (Foo).',
        ]);
    }
}
