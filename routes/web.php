<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Quote\QuoteController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::any('login', [AuthController::class, 'login']);
Route::any('logout', [AuthController::class, 'logout']);
Route::any('dev/{method}',[DevController::class, 'index']);
Route::middleware(['check_login'])->group(function () {
	Route::get('/',[HomeController::class, 'index']);
	Route::get('view/{table}', [AdminController::class, 'view']);
	Route::get('insert/{table}', [AdminController::class, 'insert']);
	Route::get('update/{table}/{id}', [AdminController::class, 'update']);
	Route::get('search-table/{table}', [AdminController::class, 'searchTable']);
	Route::get('clone/{table}/{id}', [AdminController::class, 'clone']);
	Route::post('do-insert/{table}', [AdminController::class, 'doInsert']);
	Route::post('do-insert/{table}', [AdminController::class, 'doInsert']);
	Route::post('do-update/{table}/{id}', [AdminController::class, 'doUpdate']);
	Route::post('remove', [AdminController::class, 'remove']);
	Route::post('multiple-remove', [AdminController::class, 'multipleRemove']);
	Route::post('do-config-data/{table}', [AdminController::class, 'doConfigData']);
	Route::get('get-data-json-customer', [AdminController::class, 'getDataJsonCustomer']);
	Route::get('get-data-json-linking', [AdminController::class, 'getDataJsonLinking']);

	//quotes routes
	Route::any('create-quote', [QuoteController::class, 'createQuote']);
	Route::get('get-view-customer-data', [QuoteController::class, 'getViewCustomerData']);
	Route::get('get-view-product-quantity', [QuoteController::class, 'getViewProductQuantity']);
	Route::get('add-print-paper-quote', [QuoteController::class, 'addPrintPaperQuote']);

	//orders routes
	Route::get('set-quantity-order-products', [OrderController::class, 'setListProductView']);
	Route::post('insert-orders', [OrderController::class, 'insert']);
	Route::post('update-orders/{id}', [OrderController::class, 'update']);
	Route::get('get-process-by-category', [ProductController::class, 'getProcessByCategory']);
	Route::get('get-data-table-command/{table}', [OrderController::class, 'getDataTableCommand']);
	Route::get('view-command/{table}/{id}', [OrderController::class, 'ViewCommand']);
});
