<?php

use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrademarkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth','active');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('statuses', StatusController::class);
Route::resource('types', TypeController::class);
Route::resource('trademarks', TrademarkController::class);
Route::resource('products', ProductController::class);
Route::resource('positions', PositionController::class);
