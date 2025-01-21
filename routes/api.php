<?php

use App\Http\Controllers\GeneroController;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\Login\LoginController;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
// return $request->user();
// })->middleware('auth:sanctum');

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
    'as' => 'generos.'
], function () {
    Route::get('list', [GeneroController::class, 'getAll']);
    Route::get('get/{id}', [GeneroController::class, 'getOne']);
    Route::put('update/{id}', [GeneroController::class, 'updateOne']);
    Route::post('create', [GeneroController::class,  'createOne']);
    Route::delete('delete/{id}', [GeneroController::class, 'deleteOne']);
});

Route::group([
    'prefix' => 'jogos',
    'as' => 'jogos.'
], function () {
    Route::get('list', [JogoController::class, 'getAll']);
    Route::get('get/{id}', [JogoController::class, 'getOne']);
    Route::put('update/{id}', [JogoController::class, 'updateOne']);
    Route::post('create', [JogoController::class,  'createOne']);
    Route::delete('delete/{id}', [JogoController::class, 'deleteOne']);
});
