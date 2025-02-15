<?php

use Illuminate\Support\Facades\Route;

Route::get('/version', function () {
    return 1.2;
});
Route::get('/', function () {
    return \Inertia\Inertia::render('Soon');
    return view('welcome');
});
Route::get('/command', function () {
    Artisan::call('migrate --force');
    Artisan::call('storage:link');
    return 'success';
});
