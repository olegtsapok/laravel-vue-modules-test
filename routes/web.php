<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages');
});

Route::get('/welcome', function () {
    return view('welcome');
});