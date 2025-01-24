<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ModulesController;


Route::controller(ModulesController::class)->group(function () {
    Route::post('/modules', 'modules');
    Route::get('/modules/{id}/download', 'download');
});