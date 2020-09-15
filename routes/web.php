<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GithubFavoritesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function ()  {
    Route::apiResource('dashboard', GithubController::class);
    Route::post('favorites/store', 'App\Http\Controllers\GithubFavoritesController@store' );
    Route::post('favorites/destroy', 'App\Http\Controllers\GithubFavoritesController@destroy' );
    Route::get('favorites/index', 'App\Http\Controllers\GithubFavoritesController@index' );
});

// Route::prefix('repository')->group(function () {
//     // Route::get('test', 'GithubController@index');
//     Route::apiResource('index', GithubController::class);
//     Route::apiResource('find', GithubController::class);
// });