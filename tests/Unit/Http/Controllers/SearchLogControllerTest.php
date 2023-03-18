<?php

namespace Http\Controllers;

use App\Models\PersonPublic;
use App\Models\SearchLog;
use App\Services\NameComparisonService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class SearchLogControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test store method with a search that returns matches
     *
     * @return void
     */
    public function testStoreMethodWithMatches(): void
    {
        $personPublic = PersonPublic::factory()->create([
            'name' => 'John Doe'
        ]);
        $nameComparisonServiceMock = Mockery::mock(NameComparisonService::class);
        $nameComparisonServiceMock->shouldReceive('compareNames')->once()->with('John', 'John Doe')->andReturn(100);
        $this->app->instance(NameComparisonService::class, $nameComparisonServiceMock);

        $response = $this->postJson('/search-log', [
            'name' => 'John',
            'percent_match' => 80
        ]);

        $response->assertOk();
        $response->assertJsonFragment([
            'searched_name' => 'John',
            'percentage_match' => 80,
            'execution_status' => 'records_found',
            'message' => 'Se encontraron 1 resultados.'
        ]);

        $this->assertDatabaseHas('search_logs', [
            'searched_name' => 'John',
            'percentage_match' => 80,
            'execution_status' => 'records_found'
        ]);
        $this->assertDatabaseHas('search_log_person_publics', [
            'search_log_id' => SearchLog::first()->id,
            'person_public_id' => $personPublic->id
        ]);
    }

    /**
     * Test store method with a search that returns no matches
     *
     * @return void
     */
    public function testStoreMethodWithNoMatches(): void
    {
        $response = $this->postJson('/search-log', [
            'name' => 'John',
            'percent_match' => 80
        ]);

        $response->assertUnprocessable();
        $response->assertJsonFragment([
            'searched_name' => 'John',
            'percentage_match' => 80,
            'execution_status' => 'no_matches',
            'message' => 'No se han encontrado resultados para tu búsqueda (John).',
            'matches' => []
        ]);

        $this->assertDatabaseHas('search_logs', [
            'searched_name' => 'John',
            'percentage_match' => 80,
            'execution_status' => 'no_matches'
        ]);
    }

    /**
     * Test store method with invalid input
     *
     * @return void
     */
    public function testStoreMethodWithInvalidInput(): void
    {
        $response = $this->postJson('/search-log', [
            'name' => '',
            'percent_match' => 80
        ]);

        $response->assertStatus(422);
        $response->assertJson(['error' => true, 'message' => 'El campo nombre es obligatorio.']);
    }
}
