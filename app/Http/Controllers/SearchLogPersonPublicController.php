<?php

namespace App\Http\Controllers;

use App\Models\SearchLog;
use App\Models\SearchLogPersonPublic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchLogPersonPublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getPersonPublicBySearchLog(Request $request): JsonResponse
    {
        $searchLog = SearchLog::where('uuid', $request->uuid)->first();

        if (!$searchLog) {
            return response()->json([
                'message' => 'No se ha encontrado la búsqueda solicitada.'
            ], 404);
        }

        $searchLogPersonPublics = SearchLogPersonPublic::with('personPublic')
            ->where('search_log_id', $searchLog->id)
            ->get();

        $matches = [];
        foreach ($searchLogPersonPublics as $searchLogPersonPublic) {
            $percentMatch = $searchLogPersonPublic->percent_match;

            $matches[] = [
                'name' => $searchLogPersonPublic->personPublic->name,
                'percent_match' => $percentMatch,
                'person_public' => $searchLogPersonPublic->personPublic
            ];
        }

        $executionStatus = count($matches) > 0 ? 'records_found' : 'no_matches';

        $response = [
            'uuid' => $searchLog->uuid,
            'searched_name' => $searchLog->searched_name,
            'percentage_match' => $searchLog->percentage_match,
            'execution_status' => $executionStatus,
            'matches' => $matches,
            'message' => $executionStatus === 'records_found' ? 'Se encontraron ' . (count($matches)) . ' resultados.' : 'No se han encontrado resultados para tu búsqueda (' . $searchLog->searched_name . ').'
        ];

        return response()->json($response);
    }
}
