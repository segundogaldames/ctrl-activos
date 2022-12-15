<?php
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;

use App\Http\Controllers\AdquisitionController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrademarkController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $inventories = DB::table('inventories')
        ->select(DB::raw('count(*) as cantidad, products.name as product'))
        ->join('products','products.id','=','inventories.product_id')
        ->groupBy('products.name')
        ->where('inventories.status_id', 1)
        ->get();

    return view('welcome', [
        'inventories' => $inventories,
    ]);
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
Route::resource('adquisitions', AdquisitionController::class);
Route::resource('details', DetailController::class)->only('show','edit','update');
Route::resource('inventories', InventoryController::class)->except('create','store');

//rutas especificas

Route::get('/details/addDetail/{adquisition}', [DetailController::class, 'addDetail'])->name('details.addDetail');
Route::post('/details/newDetail/{adquisition}',[DetailController::class, 'newDetail'])->name('details.newDetail');
Route::get('/inventories/addInventory/{product}', [InventoryController::class,'addInventory'])->name('inventories.addInventory');
Route::post('/inventories/newInventory/{product}', [InventoryController::class,'newInventory'])->name('inventories.newInventory');
