<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ModulesController;

Route::post('/user/auth', [AuthController::class, 'auth']);
Route::post('/user/register', [AuthController::class, 'register']);

Route::controller(ModulesController::class)->middleware('auth:sanctum')->group(function () {
    Route::post('/modules', 'modules');
    Route::get('/modules/{id}/download', 'download');
});