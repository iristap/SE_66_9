<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DurableController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

## User Routes
Route::get('/users', [App\Http\Controllers\UserController::class,'index'] )->name('users.index');
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');

## parcel Routes
Route::get('/durable', [App\Http\Controllers\DurableController::class, 'index'])->name('durable.index');
Route::delete('/durable/{id}', [DurableController::class, 'destroy'])->name('durable.destroy');
Route::get('/material', [App\Http\Controllers\MaterialController::class, 'index'])->name('material.index');
## Stock Routes
Route::get('/stocks', [App\Http\Controllers\StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/create', [App\Http\Controllers\StockController::class, 'create'])->name('stocks.create');
Route::get('/stocks/{id}', [App\Http\Controllers\StockController::class, 'show'])->name('stocks.show');
Route::post('/stocks', [App\Http\Controllers\StockController::class, 'store'])->name('stocks.store');