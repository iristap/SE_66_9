<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DurableController;
use App\Http\Controllers\DisbursementUserController;
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
Route::get('/return', [App\Http\Controllers\ReturnController::class, 'index'])->name('return.index');
Route::get('/return/{id}', [App\Http\Controllers\ReturnController::class, 'show'])->name('return.show');
Route::put('/return/{id}', [App\Http\Controllers\ReturnController::class, 'update'])->name('return.update');
Route::get('/borrow', [App\Http\Controllers\BorrowingUserController::class, 'index'])->name('borrowing.index_user');
Route::post('/borrow/confirm', [App\Http\Controllers\BorrowingUserController::class, 'confirm'])->name('borrowing.confirm_user');
Route::post('/borrow/store', [App\Http\Controllers\BorrowingUserController::class, 'store'])->name('borrowing.store_user');
Route::get('/borrow/history', [App\Http\Controllers\BorrowingUserController::class, 'index_history'])->name('borrowing.index_history');
Route::get('/borrow/history/considering', [App\Http\Controllers\BorrowingUserController::class, 'considering'])->name('borrowing.history.considering');
Route::get('/borrow/history/considered', [App\Http\Controllers\BorrowingUserController::class, 'considered'])->name('borrowing.history.considered');

Route::get('/withdraw',[App\Http\Controllers\DisbursementUserController::class,'index'])->name('withdraw.index_user');
Route::post('/withdraw/confirm',[App\Http\Controllers\DisbursementUserController::class,'confirm'])->name('withdraw.confirm_user');
Route::post('/withdraw/store', [App\Http\Controllers\DisbursementUserController::class, 'store'])->name('withdraw.store_user');
Route::get('/withdraw/history', [App\Http\Controllers\DisbursementUserController::class, 'index_history'])->name('withdraw.index_history');
Route::get('/withdraw/history/considering', [App\Http\Controllers\DisbursementUserController::class, 'considering'])->name('withdraw.history.considering');
Route::get('/withdraw/history/considered', [App\Http\Controllers\DisbursementUserController::class, 'considered'])->name('withdraw.history.considered');


## parcel Routes
Route::get('/durable', [App\Http\Controllers\DurableController::class, 'index'])->name('durable.index');
Route::get('/durable/{id}', [App\Http\Controllers\DurableController::class, 'edit'])->name('durable.edit');
Route::put('/durable/{id}', [App\Http\Controllers\DurableController::class, 'update'])->name('durable.update');
Route::delete('/durable/{id}', [App\Http\Controllers\DurableController::class, 'destroy'])->name('durable.destroy');
Route::get('/material', [App\Http\Controllers\MaterialController::class, 'index'])->name('material.index');
Route::get('/material/{id}', [App\Http\Controllers\MaterialController::class, 'edit'])->name('material.edit');
Route::put('/material/{id}', [App\Http\Controllers\MaterialController::class, 'update'])->name('material.update');
Route::delete('/material/{id}', [App\Http\Controllers\MaterialController::class, 'destroy'])->name('material.destroy');


Route::get('/borrowing', [App\Http\Controllers\BorrowingController::class,'index'] )->name('borrowing.index');
Route::get('/borrowing/details/{id}', [App\Http\Controllers\BorrowingController::class,'details'] )->name('borrowing.details');
Route::put('borrowing/a_update/{borrowing_id}/{da_id}', [App\Http\Controllers\BorrowingController::class, 'a_update'])->name('borrowing.a_update');
Route::get('/borrowing/not_approved/{id}', [App\Http\Controllers\BorrowingController::class, 'not_approved'])->name('borrowing.not_approved');
Route::put('/borrowing/not_approved/update/{id}', [App\Http\Controllers\BorrowingController::class, 'na_update'])->name('borrowing.na_update');

Route::get('/disbursement', [App\Http\Controllers\DisbursementController::class,'index'] )->name('disbursement.index');
Route::get('/disbursement/considering', [App\Http\Controllers\DisbursementController::class,'considering'] )->name('disbursement.considering');
Route::get('/disbursement/considering/details/{id}', [App\Http\Controllers\DisbursementController::class,'considering_details'] )->name('disbursement.considering_details');
Route::get('/disbursement/considering/details/approved/{id}', [App\Http\Controllers\DisbursementController::class,'approved'] )->name('disbursement.approved');
Route::put('/disbursement/considering/details/approved/update/{id}', [App\Http\Controllers\DisbursementController::class,'a_update'] )->name('disbursement.a_update');
Route::get('/disbursement/considering/details/not_approved/{id}', [App\Http\Controllers\DisbursementController::class,'not_approved'] )->name('disbursement.not_approved');
Route::put('/disbursement/considering/details/not_approved/update/{id}', [App\Http\Controllers\DisbursementController::class,'na_update'] )->name('disbursement.na_update');
Route::get('/disbursement/considered', [App\Http\Controllers\DisbursementController::class,'considered'] )->name('disbursement.considered');
Route::get('/disbursement/considered/details/{id}', [App\Http\Controllers\DisbursementController::class,'considered_details'] )->name('disbursement.considered_details');

## Stock Routes
Route::get('/stocks', [App\Http\Controllers\StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/create', [App\Http\Controllers\StockController::class, 'create'])->name('stocks.create');
Route::get('/stocks/{id}', [App\Http\Controllers\StockController::class, 'show'])->name('stocks.show');
Route::post('/stocks', [App\Http\Controllers\StockController::class, 'store'])->name('stocks.store');
Route::get('/stocks/{id}/edit', [App\Http\Controllers\StockController::class, 'edit'])->name('stocks.edit');
Route::put('/stocks/{id}', [App\Http\Controllers\StockController::class, 'update'])->name('stocks.update');
Route::delete('/stocks/{id}', [App\Http\Controllers\StockController::class, 'destroy'])->name('stocks.destroy');

## Technician Routes
Route::get('/repair', [App\Http\Controllers\RepairController::class, 'index'])->name('repair.index');
Route::get('/repair/history',[App\Http\Controllers\RepairController::class, 'history'])->name('repair.history');
Route::get('/repair/{id}',[App\Http\Controllers\RepairController::class, 'show'])->name('repair.show');
Route::put('/repair/{id}',[App\Http\Controllers\RepairController::class, 'update'])->name('repair.update');
