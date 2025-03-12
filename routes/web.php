<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::match(
    ['get', 'post'],
    '/login',
    [UserController::class, 'login']
  )->name('login');
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/', function () {
    return view('pages');
})->middleware('auth:sanctum');

Route::get('/welcome', function () {
    return view('welcome');
});