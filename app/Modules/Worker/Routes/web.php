<?php
use \App\Modules\Worker\Controllers\WorkerController;
use \App\Modules\Worker\Controllers\Auths\AuthController;
Route::prefix('Worker')->group(function()
{
    Route::any('login', [AuthController::class, 'login']);
    Route::any('logout', [AuthController::class, 'logout']);
    Route::middleware(['AdminAuthenticate'])->group(function () {
        
    });
});