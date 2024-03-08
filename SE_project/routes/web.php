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

Route::get('/durable', [App\Http\Controllers\DurableController::class, 'index'])->name('durable');

Route::get('/repair', [App\Http\Controllers\RepairController::class, 'index'])->name('repair');
