<?php

use App\Http\Controllers\GeneroController;
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

    Route::get('lista', [GeneroController::class, 'index'])->name('index');
    Route::get('{genero}/edit', [GeneroController::class, 'edit'])->name('edit');
    Route::put('{genero}', [GeneroController::class, 'update'])->name('update');
    Route::get('criar',[GeneroController::class,'create'])->name('create');
    Route::post('salvar',[GeneroController::class,'store'])->name('salvar');
    Route::delete('{genero}',[GeneroController::class,'destroy'])->name('deletar');
});
