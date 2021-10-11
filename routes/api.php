<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use Illuminate\Support\Facades\Route;

Route::prefix('agents')->group(function () {
    Route::get('', [AgentController::class, 'index']);
    Route::post('', [AgentController::class, 'store']);
    Route::get('{id}', [AgentController::class, 'show']);
    Route::put('{agent}', [AgentController::class, 'update']);
    Route::delete('{agent}', [AgentController::class, 'destroy']);
});

Route::prefix('users')->group(function () {
    Route::get('', [UserController::class, 'index']);
    Route::post('', [UserController::class, 'store']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::put('{user}', [UserController::class, 'update']);
    Route::delete('{user}', [UserController::class, 'destroy']);
});