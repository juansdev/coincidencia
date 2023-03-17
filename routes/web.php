<?php

use App\Http\Controllers\SearchLogController;
use App\Http\Controllers\SearchLogPersonPublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app');
});

Route::get('CSRF', function () {
    return response()->json(['csrf' => csrf_token()]);
});

Route::get('/search_log', [SearchLogController::class, 'index']);
Route::post('/search_log', [SearchLogController::class, 'store']);

Route::get('/get_person_public_by_search_log', [SearchLogPersonPublicController::class, 'getPersonPublicBySearchLog']);
