<?php

use App\Http\Controllers\Generos\GeneroApiController;
use App\Http\Controllers\Jogos\JogoApiController;
use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;


Route::group([
    "prefix" => "user",
    "as" => "user."
], function () {
    Route::post('create', [LoginController::class, 'apiCreateUser']);
    Route::post('login', [LoginController::class, 'apiLoginUser']);
    Route::post('logout', [LoginController::class, 'apiLogoutUser'])->middleware('auth:sanctum');
});

Route::group([
    'prefix' => 'generos',
    'as' => 'generos.',
], function () {
    Route::get('list', [GeneroApiController::class, 'getAll']);
    Route::get('get/{id}', [GeneroApiController::class, 'getOne']);
    Route::put('update/{id}', [GeneroApiController::class, 'updateOne']);
    Route::post('create', [GeneroApiController::class,  'createOne']);
    Route::delete('delete/{id}', [GeneroApiController::class, 'deleteOne']);
});

Route::group([
    'prefix' => 'jogos',
    'as' => 'jogos.'
], function () {
    Route::get('list', [JogoApiController::class, 'getAll']);
    Route::get('get/{id}', [JogoApiController::class, 'getOne']);
    Route::put('update/{id}', [JogoApiController::class, 'updateOne']);
    Route::post('create', [JogoApiController::class,  'createOne']);
    Route::delete('delete/{id}', [JogoApiController::class, 'deleteOne']);
});
