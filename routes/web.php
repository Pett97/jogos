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
});
