<?php
use Modules\Baogia\Http\Controllers\Auth\AuthController;
use Modules\Baogia\Http\Controllers\HomeController;
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

Route::prefix('baogia')->group(function() {
	Route::get('login/{user}', [AuthController::class, 'login']);
    Route::get('/', [HomeController::class, 'index']);
});
