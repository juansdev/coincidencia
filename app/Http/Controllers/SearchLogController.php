<?php

namespace App\Http\Controllers;

use App\Models\PersonPublic;
use App\Models\SearchLog;
use App\Models\SearchLogPersonPublic;
use App\Services\NameComparisonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchLogController extends Controller
{
    protected NameComparisonService $nameComparisonService;

    public function __construct(NameComparisonService $nameComparisonService)
    {
        $this->nameComparisonService = $nameComparisonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $searchLogs = SearchLog::all();
        return response()->json([
            'data' => $searchLogs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // Validamos la petición
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'percent_match' => 'required|integer|between:0,100'
        ]);

        if ($validator->fails())
            return response()->json([
                'error' => true,
                'message' => $validator->errors()->first()
            ], 422);

        // Limpieza y normalización de nombres
        $searchedName = trim(strtoupper($request->input('name')));
        $searchedName = str_replace(['Á', 'É', 'Í', 'Ó', 'Ú'], ['A', 'E', 'I', 'O', 'U'], $searchedName);
        $searchedName = preg_replace('/\s+/', ' ', $searchedName);

        // Buscamos las personas públicas que coincidan
        $personPublics = PersonPublic::with(['department', 'municipality', 'location', 'typePerson', 'typePosition'])->get();
        $matches = [];
        foreach ($personPublics as $personPublic) {
            // Limpieza y normalización de nombres
            $personName = trim(strtoupper($personPublic->name));
            $personName = str_replace(['Á', 'É', 'Í', 'Ó', 'Ú'], ['A', 'E', 'I', 'O', 'U'], $personName);
            $personName = preg_replace('/\s+/', ' ', $personName);

            $percentMatch = $this->nameComparisonService->compareNames($searchedName, $personName);

            if ($percentMatch >= $request->input('percent_match'))
                $matches[] = [
                    'name' => $personPublic->name,
                    'percent_match' => $percentMatch,
                    'person_public' => $personPublic
                ];
        }

        // Creamos un registro en la tabla de logs
        $executionStatus = count($matches) > 0 ? 'records_found' : 'no_matches';
        $uuid = uniqid();
        $searchLog = new SearchLog([
            'uuid' => $uuid,
            'searched_name' => $request->input('name'),
            'percentage_match' => $request->input('percent_match'),
            'execution_status' => $executionStatus
        ]);
        $searchLog->save();

        // Guardamos el registro y sus relaciones en la base de datos
        foreach ($matches as $match) {
            $searchLogPersonPublic = new SearchLogPersonPublic();
            $searchLogPersonPublic->search_log_id = $searchLog->id;
            $searchLogPersonPublic->person_public_id = PersonPublic::where('name', $match['person_public']->name)->first()->id;
            $searchLogPersonPublic->save();
        }

        // Preparamos la respuesta
        $response = [
            'uuid' => $uuid,
            'searched_name' => $request->input('name'),
            'percentage_match' => $request->input('percent_match'),
            'execution_status' => $executionStatus,
            'matches' => $matches,
            'message' => $executionStatus === 'records_found' ? 'Se encontraron ' . (count($matches)) . ' resultados.' : 'No se han encontrado resultados para tu búsqueda (' . $request->input('name') . ').'
        ];

        // Devolvemos la respuesta
        return response()->json($response, $executionStatus === 'records_found' ? 200 : 422);
    }
}
