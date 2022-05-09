<?php

use App\Http\Controllers\Api\AcessanteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('acessantes',AcessanteController::class);
// Route::apiResource('posts',PostController::class);

// API(Endpoints) acessantes 
// Route::get('/acessantes', [AcessanteController::class, 'index']);

// Route::post('/acessantes', [AcessanteController::class, 'store']);

// Route::put('/acessantes/{$id}', [AcessanteController::class, 'update']);

// Route::delete('/acessantes/{$id}/', [AcessanteController::class, 'destroy']);

// Route::get('acessantes', ['as' => 'cadastro.acessante', 'uses' => 'App\Http\Controllers\AcessanteController@index']);

Route::get('acessantes', 'App\Http\Controllers\Api\AcessanteController@index');
Route::get('acessantes/{id}', 'App\Http\Controllers\Api\AcessanteController@show');
Route::post('/acessantes', 'App\Http\Controllers\Api\AcessanteController@store');
Route::put('acessantes/{id}', 'App\Http\Controllers\Api\AcessanteController@update');
Route::delete('acessantes/{id}', 'App\Http\Controllers\Api\AcessanteController@destroy');