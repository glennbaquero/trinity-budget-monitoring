<?php

Route::get('/user-acc', function () {
    return view('web.pages.manager.user-acc');
});

Route::namespace('Manager')->name('manager.')->group(function() {
    Route::namespace('Auth')->group(function() {
        Route::get('logout', 'LoginController@logout')->name('logout');
        Route::get('email/reset', 'VerificationController@resend')->name('verification.resend');
        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    
        /* Guest Routes */
        Route::middleware('guest:manager')->group(function() {
            Route::get('login', 'LoginController@showLoginForm')->name('login');
            Route::post('login', 'LoginController@login');
            Route::get('reset-password/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('reset-password/change', 'ResetPasswordController@reset')->name('password.change');
            Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::post('forgot-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        });
        Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
    });
    Route::middleware('auth:manager')->group(function() {

        Route::get('/main-budget', 'DashboardController@index')->name('dashboard');
        Route::post('/main-budget/type', 'DashboardController@update')->name('dashboard.type');
        Route::post('/main-budget/filter', 'DashboardController@filter')->name('dashboard.filter');
        Route::post('/main-budget/dashboard-update', 'DashboardController@doughnutUpdate')->name('dashboard.doughnut-update');
        
        Route::namespace('PO')->group(function() {
            Route::get('/po-request', 'PORequestController@index')->name('po-request.index');
            Route::get('/view-po-request/{id}', 'PORequestController@show')->name('po-request.show');
            Route::post('/update-po-request/{id}', 'PORequestController@update')->name('po-request.update');
            Route::post('/po-request/fetch', 'PORequestFetchController@fetch')->name('po-request.fetch');
            Route::post('/po-request/fetch?archived=1', 'PORequestFetchController@fetch')->name('po-request.fetch-archive');
            Route::post('/po-request/fetch-pagination/{id}', 'PORequestFetchController@fetchPagePagination')->name('po-request.fetch-pagination');
        });
        Route::namespace('PPP')->group(function() {
            Route::get('/ppp-budget', 'PPPRequestController@index')->name('ppp-request.index');
            Route::get('/view-ppp-request/{id}', 'PPPRequestController@show')->name('ppp-request.show');
            Route::post('/update-ppp-request/{id}', 'PPPRequestController@update')->name('ppp-request.update');
            Route::get('/add-ppp-budget', 'PPPRequestController@create')->name('ppp-request.create');
            Route::get('/view-ppp-budget/{id}', 'PPPRequestController@show')->name('ppp-request.show');
            Route::post('/store-ppp-request', 'PPPRequestController@store')->name('ppp-request.store');
            Route::post('/resubmit-ppp-request/{id}', 'PPPRequestController@update')->name('ppp-request.update');
            Route::post('/ppp-request/fetch', 'PPPRequestFetchController@fetch')->name('ppp-request.fetch');
            Route::post('/ppp-request/fetch?archived=1', 'PPPRequestFetchController@fetch')->name('ppp-request.fetch-archive');
            Route::post('/ppp-request/fetch-pagination/{id}', 'PPPRequestFetchController@fetchPagePagination')->name('ppp-request.fetch-pagination');
        });
        Route::namespace('Exports')->group(function() {
            Route::post('ppp-requests/export', 'ExportController@ppp')->name('ppp.export');
            Route::post('po-requests/export', 'ExportController@po')->name('po.export');
            Route::get('po-requests/export/index', 'ExportController@index')->name('po.export.index');
        });

         Route::namespace('Profiles')->group(function() {
            /**
             * @Manager Profiles
             */
            Route::get('profile', 'ProfileController@show')->name('profiles.show');
            Route::post('profile/update', 'ProfileController@update')->name('profiles.update');
            Route::post('profile/change-password', 'ProfileController@changePassword')->name('profiles.change-password');

            Route::post('profile/fetch', 'ProfileController@fetch')->name('profiles.fetch');

        });
    });
});



