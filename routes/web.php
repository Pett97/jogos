<?php

use App\Http\Controllers\GeneroController;
use App\Http\Controllers\JogoController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts/app');
});


//genero
Route::group([
    'prefix' => 'generos',
    'as' => 'generos.'
], function () {

    // MONOLITO
    Route::get('lista', [GeneroController::class, 'index'])->name('index');
    Route::get('{genero}/edit', [GeneroController::class, 'edit'])->name('edit');
    Route::put('{genero}', [GeneroController::class, 'update'])->name('update');
    Route::get('criar', [GeneroController::class, 'create'])->name('create');
    Route::post('salvar', [GeneroController::class, 'store'])->name('salvar');
    Route::delete('{genero}', [GeneroController::class, 'destroy'])->name('deletar');
});

//jogos
Route::group([
    'prefix' => 'jogos',
    'as' => 'jogos.'
], function () {
    Route::get('lista',[JogoController::class,'index'])->name('index');
    Route::get('{jogo}/edit', [JogoController::class, 'edit'])->name('edit');
    Route::put('{jogo}', [JogoController::class, 'update'])->name('update');
    Route::get('criar', [JogoController::class, 'create'])->name('create');
    Route::post('salvar', [JogoController::class, 'store'])->name('salvar');
    Route::delete('{jogo}', [JogoController::class, 'destroy'])->name('deletar');
});
