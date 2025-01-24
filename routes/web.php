<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('modules');
});

Route::get('/welcome', function () {
    return view('welcome');
});