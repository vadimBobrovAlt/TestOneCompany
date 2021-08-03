<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('/auth/token', [AuthController::class,'token'])->middleware('throttle:5');
    Route::middleware(['auth:sanctum','throttle:60'])->group(function () {
        Route::group(['prefix' => 'tasks'], function () {
            Route::post('/', [TaskController::class, 'store']);
            Route::get('/', [TaskController::class, 'index']);
            Route::get('/{id}', [TaskController::class, 'show'])->where('id', '[0-9]+');
            Route::put('/{id}', [TaskController::class, 'store'])->where('id', '[0-9]+');
            Route::delete('/{id}', [TaskController::class, 'destroy'])->where('id', '[0-9]+');
        });
    });
});
