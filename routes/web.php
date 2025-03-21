<?php

use Illuminate\Support\Facades\Route;

Route::get('/deploy',function (){
    return Artisan::call('app:deploy');
});
Route::get('/version', function () {
    return 2.0;
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
Route::get('/fresh', function () {
    Artisan::call('migrate:fresh --force');
    Artisan::call('db:seed --force');
    return 'success';
});
Route::get('/set-supplier-account', function () {
    \App\Models\Supplier::query()->get()->each(function ($supplier){
        \App\Services\SupplierService::make()->setCurrentAccount($supplier);
    });
    return 'success';
});
