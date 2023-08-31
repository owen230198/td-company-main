<?php
use \App\Modules\Worker\Controllers\WorkerController;
use \App\Modules\Worker\Controllers\Auths\AuthController;
Route::prefix('Worker')->group(function()
{
    Route::any('login', [AuthController::class, 'login']);
    Route::any('logout', [AuthController::class, 'logout']);
    Route::middleware(['WorkerAuth'])->group(function () {
        Route::get('', [WorkerController::class, 'index']);
        Route::any('action-command/{action}', [WorkerController::class, 'actionCommand']);
    });
});