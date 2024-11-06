<?php

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
    return view('welcome');
});

Route::get('home',[\App\Http\Controllers\HomeController::class,'home'])->name('home');
Route::post('store',[\App\Http\Controllers\HomeController::class,'store'])->name('store');
Route::post('toggle/{id}',[\App\Http\Controllers\HomeController::class,'toggle'])->name('toggle')
->where('id','[0-9]+');
Route::post('update/{id}',[\App\Http\Controllers\HomeController::class,'update'])->name('update')
    ->where('id','[0-9]+');
Route::get('update/{id}',[\App\Http\Controllers\HomeController::class,'izmena'])->name('izmena')
    ->where('id','[0-9]+');

Route::post('delete/{id}',[\App\Http\Controllers\HomeController::class,'delete'])->name('delete')
    ->where('id','[0-9]+');
