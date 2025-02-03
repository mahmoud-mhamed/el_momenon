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

    Route::group(['prefix' => 'role','as' => 'roles.'], function () {
        Route::get('/', \App\Actions\Roles\RolesIndexAction::class)->name('index');
        Route::get('/create', [\App\Actions\Roles\RolesStoreAction::class, 'viewForm'])->name('create');
        Route::post('/store', \App\Actions\Roles\RolesStoreAction::class)->name('store');
        Route::get('/edit/{role}', [\App\Actions\Roles\RolesUpdateAction::class, 'viewForm'])->name('edit');
        Route::post('/update/{role}', \App\Actions\Roles\RolesUpdateAction::class)->name('update');
        Route::delete('/{role}', \App\Actions\Roles\RoleDeleteAction::class)->name('delete');

    });


    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
//        Route::get('/edit-auth', \App\Actions\HomeAction::class)->name('view-edit-auth');

        Route::get('/', \App\Actions\User\UserIndexAction::class)->name('index');
        Route::post('/', \App\Actions\User\UserStoreAction::class)->name('store');
        Route::post('/{user}', \App\Actions\User\UserUpdateAction::class)->name('update');
        Route::delete('/{user}', \App\Actions\User\UserDeleteAction::class)->name('delete');

        Route::post('/{user}/edit-custom-permission', \App\Actions\User\UserEditCustomPermissionAction::class)->name('edit-custom-permission');
        Route::delete('/{user}/remove-custom-permission', \App\Actions\User\RemoveCustomPermissionAction::class)->name('remove-custom-permission');

        Route::group(['prefix' => 'profile/{user}', 'as' => 'profile.'], function () {
            Route::get('/', [\App\Actions\User\UserProfileAction::class, 'viewMainData'])->name('main_data');
            Route::get('/edit', [\App\Actions\User\UserProfileAction::class, 'viewEdit'])->name('edit');
        });
    });
});
