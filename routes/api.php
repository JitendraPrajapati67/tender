<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
//    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
//    Route::apiResource('roles', 'RolesApiController');

    // Users
//    Route::apiResource('users', 'UsersApiController');

    // Tender Categories
//    Route::apiResource('tender-categories', 'TenderCategoryApiController');
});
