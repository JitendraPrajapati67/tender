<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();
Route::get("login/{number}/otp","Auth\LoginController@otp")->name("auth.otp");
Route::post("login/verification","Auth\LoginController@otpVerification")->name("auth.otp.verification");
Route::get("login/{number}/opt/resend","Auth\LoginController@resendOTP")->name("auth.otp.resend");

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin\Auth'], function () {
    Route::get("login","LoginController@showLoginForm")->name("login");
    Route::post("login","LoginController@login")->name("login");
    Route::post('logout', 'LoginController@logout')->name('logout');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Tender Categories
    Route::delete('tender-categories/destroy', 'TenderCategoryController@massDestroy')->name('tender-categories.massDestroy');
    Route::resource('tender-categories', 'TenderCategoryController');

    // Tender
    Route::delete('tender/destroy', 'TenderController@massDestroy')->name('tender.massDestroy');
    Route::delete('tender/destroydoc', 'TenderController@destroyDocument')->name('tender.destroyDocument');
    Route::delete('tender/status', 'TenderController@status')->name('tender.status');

    //Tender Invitation
    Route::get('tender/invitation', 'TenderInvitationController@index')->name('tender.invitation');
    Route::post('tender/invitation/users', 'TenderInvitationController@users')->name('tender.invitation.users');
    Route::post('tender/invitation/send', 'TenderInvitationController@sendTenderInvitation')->name('tender.invitation.send');

    Route::resource('tender', 'TenderController');


    // Bidder Managers
    Route::delete('bidder-managers/destroy', 'BidderManagerController@massDestroy')->name('bidder-managers.massDestroy');
    Route::resource('bidder-managers', 'BidderManagerController');

    // Materials
    Route::delete('materials/destroy', 'MaterialController@massDestroy')->name('materials.massDestroy');
    Route::resource('materials', 'MaterialController');

    Route::get('user-alerts/read', 'UserAlertsController@read');
});
Route::resource('bid','BidController');
Route::delete('bid/destroydoc','BidController@destroyDocument')->name('bid.destroyDocument');
Route::get('bid/getDownload/{name}','BidController@getDownload')->name('bid.getDownload');
Route::get('bid/create/{var1}', 'BidController@create');


Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
