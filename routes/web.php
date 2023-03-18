<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchLogController;
use App\Http\Controllers\SearchLogPersonPublicController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    if (!User::all()->first())
        return redirect('/register');
    return redirect('/home');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/search-log', [SearchLogController::class, 'index']);
Route::post('/search-log', [SearchLogController::class, 'store']);

Route::get('/get-person-public-by-search-log', [SearchLogPersonPublicController::class, 'getPersonPublicBySearchLog']);
