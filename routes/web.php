<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
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
Route::any('dev-update-data',[HomeController::class, 'devUpdateData']);
Route::middleware(['checkLogin'])->group(function () {
	Route::get('/',[HomeController::class, 'index']);
	Route::get('permission-error',[AdminController::class, 'permissionError']);
});
