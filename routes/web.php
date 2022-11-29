<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('sandbox', 'SandboxController@index')->name('sandbox.index');

Route::post('ckeditor/upload', 'CkeditorController@upload');

Route::namespace('Web')->name('web.')->group(function() {

	Route::namespace('Auth')->group(function() {

		/* Guest Routes */
		Route::middleware('guest:web')->group(function() {

	        Route::get('', 'LoginController@showLoginForm');
	        Route::get('/sales/login', 'LoginController@showLoginForm')->name('login');
	        Route::post('/sales/login', 'LoginController@login');

	        Route::get('/sales/reset-password/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
	        Route::post('/sales/reset-password/change', 'ResetPasswordController@reset')->name('password.change');

	        Route::get('/sales/forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
	        Route::post('/sales/forgot-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

	        // Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
	        // Route::post('register', 'RegisterController@register');

	         /* Socialite Login */
	  		// Route::get('socialite/{provider}/login', 'SocialiteLoginController@login')->name('socialite.login');
			// Route::get('socialite/{provider}/callback', 'SocialiteLoginController@callback')->name('socialite.callback');

			// /* Facebook Login */
			// Route::get('socialite/facebook/login', 'SocialiteLoginController@login')->name('facebook.login');
			// Route::get('socialite/facebook/callback', 'SocialiteLoginController@callback')->name('facebook.callback');

		});

        Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');

	});

	/* Page Routes */
	Route::namespace('Pages')->group(function() {

		// Route::get('home', 'PageController@showHome')->name('home');
		// Route::get('about-us', 'PageController@showAbout')->name('about');
		// Route::get('terms-and-conditions', 'PageController@showTerms')->name('terms');
		// Route::get('privacy-policy', 'PageController@showPrivacy')->name('privacy');

	});

	/* Article Routes */
	Route::namespace('Articles')->group(function() {
		
		Route::get('articles', 'ArticleController@index')->name('articles.index');
		Route::get('articles/show/{id}/{slug?}', 'ArticleController@show')->name('articles.show');

		Route::post('articles/fetch', 'ArticleFetchController@fetch')->name('articles.fetch');
		Route::post('articles/fetch-item/{id?}', 'ArticleFetchController@fetchView')->name('articles.fetch-item');
		Route::post('articles/fetch-pagination/{id}', 'ArticleFetchController@fetchPagePagination')->name('articles.fetch-pagination');
	});
	Route::middleware('auth:web')->group(function() {
		Route::namespace('PO')->group(function() {

			Route::get('/sales/po-request', 'PORequestController@index')->name('po-request.index');
			Route::get('/sales/add-po-request', 'PORequestController@create')->name('po-request.create');
			Route::get('/sales/view-po-request/{id}', 'PORequestController@show')->name('po-request.show');
			Route::post('/sales/store-po-request', 'PORequestController@store')->name('po-request.store');
			Route::post('/sales/update-po-request/{id}', 'PORequestController@update')->name('po-request.resubmit');
			Route::post('/sales/archive-po-request/{id}', 'PORequestController@archive')->name('po-request.archive');
			Route::post('/sales/restore-po-request/{id}', 'PORequestController@restore')->name('po-request.restore');
			Route::get('/sales/po-download/{id}', 'PORequestController@convertToPDF')->name('po-request.download');
			

			Route::post('/sales/po-request/fetch', 'PORequestFetchController@fetch')->name('po-request.fetch');
            Route::post('/sales/po-request/fetch?archived=1', 'PORequestFetchController@fetch')->name('po-request.fetch-archive');
            Route::post('/sales/po-request/fetch-pagination/{id}', 'PORequestFetchController@fetchPagePagination')->name('po-request.fetch-pagination');
	    });
	});

	Route::middleware('auth:web')->group(function() {
		Route::namespace('PPP')->group(function() {
			Route::get('/sales/ppp-budget', 'PPPAvailableController@index')->name('ppp-available.ppp-budget');
            Route::post('/sales/ppp-budget/type', 'PPPAvailableController@update')->name('ppp-available.ppp-budget.type');
            Route::post('/sales/ppp-budget/dashboard-update', 'PPPAvailableController@doughnutUpdate')->name('ppp-available.ppp-budget.doughnut-update');	


			Route::post('/sales/ppp-budget/fetch', 'PPPAvailableFetchController@fetch')->name('ppp-available.fetch');			


	    });
	});


	/* User Dashboard Routes */

	Route::prefix('sales')->middleware('auth:web')->group(function() {
		Route::namespace('Auth')->group(function() {

			Route::get('logout', 'LoginController@logout')->name('logout');

	        Route::get('email/reset', 'VerificationController@resend')->name('verification.resend');
	        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');

		});



		Route::middleware('verified')->group(function() {

			Route::get('dashboard', 'DashboardController@index')->name('dashboard');

			/**
	         * @Count Fetch Controller
	         */
	        Route::post('count/notifications', 'CountFetchController@fetchNotificationCount')->name('counts.fetch.notifications');

			Route::namespace('Profiles')->group(function() {

	            /**
	             * @Profiles
	             */
	            Route::get('profile', 'ProfileController@show')->name('profiles.show');
	            Route::post('profile/update', 'ProfileController@update')->name('profiles.update');
	            Route::post('profile/change-password', 'ProfileController@updatePassword')->name('profiles.change-password');

	            Route::post('profile/fetch', 'ProfileController@fetch')->name('profiles.fetch');

	        });

			Route::namespace('Notifications')->group(function() {

	            Route::get('notifications', 'NotificationController@index')->name('notifications.index');
	            Route::post('notifications/all/mark-as-read', 'NotificationController@readAll')->name('notifications.read-all');
	            Route::post('notifications/{id}/read', 'NotificationController@read')->name('notifications.read');
	            Route::post('notifications/{id}/unread', 'NotificationController@unread')->name('notifications.unread');
	            
	            Route::post('notifications-fetch', 'NotificationFetchController@fetch')->name('notifications.fetch');
	            Route::post('notifications-fetch?read=1', 'NotificationFetchController@fetch')->name('notifications.fetch-read');
	            Route::post('notifications-fetch?unread=1', 'NotificationFetchController@fetch')->name('notifications.fetch-unread');

	        });

			Route::namespace('ActivityLogs')->group(function() {

	            Route::get('activity-logs', 'ActivityLogController@index')->name('activity-logs.index');
	            
	            Route::post('activity-logs/fetch', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch');
	            Route::post('activity-logs/fetch?id={id}&sample=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.sample-items');
	            Route::post('activity-logs/fetch?profile=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.profiles');

	        });


	        Route::namespace('Samples')->group(function() {

				Route::get('sample-items', 'SampleItemController@index')->name('sample-items.index');
				Route::get('sample-items/create', 'SampleItemController@create')->name('sample-items.create');
				Route::post('sample-items/store', 'SampleItemController@store')->name('sample-items.store');
				Route::get('sample-items/show/{id}', 'SampleItemController@show')->name('sample-items.show');
				Route::post('sample-items/update/{id}', 'SampleItemController@update')->name('sample-items.update');
				Route::post('sample-items/{id}/archive', 'SampleItemController@archive')->name('sample-items.archive');
			    Route::post('sample-items/{id}/restore', 'SampleItemController@restore')->name('sample-items.restore');
			    Route::post('sample-items/{id}/remove-image', 'SampleItemController@removeImage')->name('sample-items.remove-image');

			    Route::post('sample-items/{id}/approve', 'SampleItemController@approve')->name('sample-items.approve');
			    Route::post('sample-items/{id}/deny', 'SampleItemController@deny')->name('sample-items.deny');

				Route::post('sample-items/fetch', 'SampleItemFetchController@fetch')->name('sample-items.fetch');
				Route::post('sample-items/fetch?archived=1', 'SampleItemFetchController@fetch')->name('sample-items.fetch-archive');
				Route::post('sample-items/fetch-item/{id?}', 'SampleItemFetchController@fetchView')->name('sample-items.fetch-item');
				Route::post('sample-items/fetch-pagination/{id}', 'SampleItemFetchController@fetchPagePagination')->name('sample-items.fetch-pagination');

			});	        

		});

	});
});


