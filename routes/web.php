<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/login-by-user-id/{user}', function (User $user) {
    abort_if(\Illuminate\Support\Facades\Auth::id() != 1, 404);
    Auth::login($user);

    return $user;
});
Route::get('/deploy', function () {
    return Artisan::call('app:deploy');
});
Route::get('/version', function () {
    return 3.42;
});
Route::get('/', function () {
    return redirect()->route('dashboard.login.view-form');
    return \Inertia\Inertia::render('Soon');
    return view('welcome');
});
Route::get('/command', function () {
    Artisan::call('migrate --force');
    Artisan::call('storage:link');
    return 'success';
});
Route::get('/command2', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return 'success';
});
Route::get('/fresh', function () {
    Artisan::call('migrate:fresh --force');
    Artisan::call('db:seed --force');
    return 'success';
});
Route::get('/set-supplier-account', function () {
    \App\Models\Supplier::query()->get()->each(function ($supplier) {
        \App\Services\SupplierService::make()->setCurrentAccount($supplier);
    });
    return 'success';
});
