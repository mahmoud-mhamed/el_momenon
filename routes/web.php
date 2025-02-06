<?php

use Illuminate\Support\Facades\Route;

Route::get('/version', function () {
    return 1.0;
});
Route::get('/', function () {
    return \Inertia\Inertia::render('Soon');
    return view('welcome');
});
