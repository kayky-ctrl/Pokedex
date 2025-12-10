<?php

use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('signup', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('signin', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    Route::get('/trainer/data', [\App\Http\Controllers\AuthController::class, 'trainerData']);

    Route::post('/pokemon/read', [\App\Http\Controllers\PokemonController::class, 'read']);
    Route::get('/pokemon/list', [\App\Http\Controllers\PokemonController::class, 'list']);
    Route::post('/pokemon/view', [\App\Http\Controllers\PokemonController::class, 'view']);
});
