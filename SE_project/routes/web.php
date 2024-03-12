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
Route::get('/borrow', [App\Http\Controllers\BorrowingController::class, 'index'])->name('borrowing.index');
Route::post('/borrow/confirm', [App\Http\Controllers\BorrowingController::class, 'confirm'])->name('borrowing.confirm');
Route::post('/borrow/store', [App\Http\Controllers\BorrowingController::class, 'store'])->name('borrowing.store');


## parcel Routes
Route::get('/durable', [App\Http\Controllers\DurableController::class, 'index'])->name('durable.index');
Route::get('/durable/{id}', [App\Http\Controllers\DurableController::class, 'edit'])->name('durable.edit');
Route::put('/durable/{id}', [App\Http\Controllers\DurableController::class, 'update'])->name('durable.update');
Route::delete('/durable/{id}', [App\Http\Controllers\DurableController::class, 'destroy'])->name('durable.destroy');
Route::get('/material', [App\Http\Controllers\MaterialController::class, 'index'])->name('material.index');
Route::get('/material/{id}', [App\Http\Controllers\MaterialController::class, 'edit'])->name('material.edit');
Route::put('/material/{id}', [App\Http\Controllers\MaterialController::class, 'update'])->name('material.update');
Route::delete('/material/{id}', [App\Http\Controllers\MaterialController::class, 'destroy'])->name('material.destroy');

## Stock Routes
Route::get('/stocks', [App\Http\Controllers\StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/create', [App\Http\Controllers\StockController::class, 'create'])->name('stocks.create');
Route::get('/stocks/{id}', [App\Http\Controllers\StockController::class, 'show'])->name('stocks.show');
Route::post('/stocks', [App\Http\Controllers\StockController::class, 'store'])->name('stocks.store');

## Technician Routes
Route::get('/repair', [App\Http\Controllers\RepairController::class, 'index'])->name('repair.index');
Route::get('/repair/history',[App\Http\Controllers\RepairController::class, 'history'])->name('repair.history');
Route::get('/repair/{id}',[App\Http\Controllers\RepairController::class, 'show'])->name('repair.show');
Route::post('/repair/{id}',[App\Http\Controllers\RepairController::class, 'update'])->name('repair.update');
