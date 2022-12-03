<?php

use App\Http\Controllers\AdquisitionController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
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
Route::resource('employees', EmployeeController::class);
Route::resource('areas', AreaController::class);
Route::resource('cities', CityController::class);
Route::resource('providers', ProviderController::class);
Route::resource('adquisitions', AdquisitionController::class)->only('index','show','create','store');
