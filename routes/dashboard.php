<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['guest'],
], function () {
    Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
        Route::get('/', [\App\Actions\User\LoginAction::class, 'viewForm'])->name('view-form');
        Route::post('/', \App\Actions\User\LoginAction::class)->name('save');
    });
});
Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    Route::post('/logout', \App\Actions\User\UserLogoutAction::class)->name('logout');
    Route::get('/', \App\Actions\DashboardHomeAction::class)->name('home');


});
