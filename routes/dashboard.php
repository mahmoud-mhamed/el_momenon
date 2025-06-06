<?php

use Illuminate\Support\Facades\Route;
use \App\Actions;

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

    Route::group(['prefix' => 'role', 'as' => 'roles.'], function () {
        Route::get('/', \App\Actions\Roles\RolesIndexAction::class)->name('index');
        Route::get('/create', [\App\Actions\Roles\RolesStoreAction::class, 'viewForm'])->name('create');
        Route::post('/store', \App\Actions\Roles\RolesStoreAction::class)->name('store');
        Route::get('/edit/{role}', [\App\Actions\Roles\RolesUpdateAction::class, 'viewForm'])->name('edit');
        Route::post('/update/{role}', \App\Actions\Roles\RolesUpdateAction::class)->name('update');
        Route::delete('/{role}', \App\Actions\Roles\RoleDeleteAction::class)->name('delete');

    });


    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
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

    Route::group(['prefix' => 'currency', 'as' => 'currency.'], function () {
        Route::get('/', \App\Actions\Currency\CurrencyIndexAction::class)->name('index');
        Route::post('/', \App\Actions\Currency\CurrencyStoreAction::class)->name('store');
        Route::post('/{currency}', \App\Actions\Currency\CurrencyUpdateAction::class)->name('update');
        Route::delete('/{currency}', \App\Actions\Currency\CurrencyDeleteAction::class)->name('delete');
    });

    Route::group(['prefix' => 'supplier', 'as' => 'supplier.'], function () {
        Route::get('/', \App\Actions\Supplier\SupplierIndexAction::class)->name('index');
        Route::post('/', \App\Actions\Supplier\SupplierStoreAction::class)->name('store');
        Route::post('/{supplier}', \App\Actions\Supplier\SupplierUpdateAction::class)->name('update');
        Route::delete('/{supplier}', \App\Actions\Supplier\SupplierDeleteAction::class)->name('delete');

        Route::group(['prefix' => 'profile/{supplier}', 'as' => 'profile.'], function () {
            Route::get('/view-bills', [\App\Actions\Supplier\SupplierProfileAction::class, 'viewBills'])->name('view-bills');
            Route::get('/view-payment', [\App\Actions\Supplier\SupplierProfileAction::class, 'viewBillPayment'])->name('view-payment');
        });
    });

    Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
        Route::get('/', \App\Actions\Client\ClientIndexAction::class)->name('index');
        Route::post('/', \App\Actions\Client\ClientStoreAction::class)->name('store');
        Route::post('/{client}', \App\Actions\Client\ClientUpdateAction::class)->name('update');
        Route::delete('/{client}', \App\Actions\Client\ClientDeleteAction::class)->name('delete');

        Route::group(['prefix' => 'profile/{client}', 'as' => 'profile.'], function () {
            Route::get('/', [\App\Actions\Client\ClientProfileAction::class, 'viewMainData'])->name('main_data');
            Route::get('/view-bills', [\App\Actions\Client\ClientProfileAction::class, 'viewBills'])->name('view-bills');
            Route::get('/view-archive', [\App\Actions\Client\ClientProfileAction::class, 'viewArchive'])->name('view-archive');
            Route::get('/view-payment', [\App\Actions\Client\ClientProfileAction::class, 'viewBillPayment'])->name('view-payment');
        });
    });


    Route::group(['prefix' => 'employee', 'as' => 'employee.'], function () {
        Route::get('/', \App\Actions\Employee\EmployeeIndexAction::class)->name('index');
        Route::post('/', \App\Actions\Employee\EmployeeStoreAction::class)->name('store');
        Route::post('/{employee}', \App\Actions\Employee\EmployeeUpdateAction::class)->name('update');
        Route::delete('/{employee}', \App\Actions\Employee\EmployeeDeleteAction::class)->name('delete');

        Route::get('/{employee}/salary/index', \App\Actions\Employee\EmployeeSalaryIndexAction::class)->name('employee-salary');
    });

    Route::group(['prefix' => 'bill', 'as' => 'bill.'], function () {
        Route::get('/', \App\Actions\Bill\BillIndexAction::class)->name('index');
        Route::get('/create', [\App\Actions\Bill\BillStoreAction::class, 'viewForm'])->name('create');
        Route::post('/store', \App\Actions\Bill\BillStoreAction::class)->name('store');
        Route::get('/{bill}/edit', [\App\Actions\Bill\BillUpdateAction::class, 'viewForm'])->name('edit');
        Route::post('/{bill}/update', \App\Actions\Bill\BillUpdateAction::class)->name('update');
        Route::delete('/{bill}', Actions\Bill\BillDeleteAction::class)->name('delete');

        Route::group(['prefix' => 'profile/{bill}', 'as' => 'profile.'], function () {
            Route::get('/', [\App\Actions\Bill\BillProfileAction::class, 'viewMainData'])->name('main_data');
            Route::get('/view-archive', [\App\Actions\Bill\BillProfileAction::class, 'viewArchive'])->name('view-archive');
            Route::get('payment/{type}', [\App\Actions\Bill\BillProfileAction::class, 'viewPayment'])->name('view-payment');
        });

    });

    Route::group(['prefix' => 'bill-payment', 'as' => 'bill-payment.'], function () {
        Route::delete('{billPayment}', Actions\BillPayment\BillPaymentDeleteAction::class)->name('delete-payment-bill');

        Route::post('store/{bill}', Actions\BillPayment\BillPaymentStoreAction::class)->name('store');
        Route::post('update/{billPayment}', Actions\BillPayment\BillPaymentUpdateAction::class)->name('update');

    });

    Route::group(['prefix' => 'salary', 'as' => 'salary.'], function () {
        Route::get('/', \App\Actions\Salary\SalaryIndexAction::class)->name('index');
        Route::post('/', \App\Actions\Salary\SalaryStoreAction::class)->name('store');
        Route::post('/{salary}', \App\Actions\Salary\SalaryUpdateAction::class)->name('update');
        Route::delete('/{salary}', \App\Actions\Salary\SalaryDeleteAction::class)->name('delete');
    });


    Route::group(['prefix' => 'expense', 'as' => 'expense.'], function () {
        Route::get('/', \App\Actions\Expense\ExpenseIndexAction::class)->name('index');
        Route::post('/', \App\Actions\Expense\ExpenseStoreAction::class)->name('store');
        Route::post('/{expense}', \App\Actions\Expense\ExpenseUpdateAction::class)->name('update');
        Route::delete('/{expense}', \App\Actions\Expense\ExpenseDeleteAction::class)->name('delete');
    });
    Route::group(['prefix' => 'notebook', 'as' => 'notebook.'], function () {
        Route::get('/', \App\Actions\Notebook\NotebookIndexAction::class)->name('index');
        Route::post('/', \App\Actions\Notebook\NotebookStoreAction::class)->name('store');
        Route::post('/{notebook}', \App\Actions\Notebook\NotebookUpdateAction::class)->name('update');
        Route::delete('/{notebook}', \App\Actions\Notebook\NotebookDeleteAction::class)->name('delete');
    });

    Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
        Route::get('/', \App\Actions\Report\ReportIndexAction::class)->name('index');
    });

});
