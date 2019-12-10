<?php
        Route::group([
            'prefix' => 'roles',
            'middleware' => 'jwt'
        ], function () {
            Route::get('/{id}', 'Api\RolesController@edit');
            Route::put('/{id}', 'Api\RolesController@update');
            Route::delete('/{id}', 'Api\RolesController@destroy');
            Route::get('/', 'Api\RolesController@index');
            Route::post('/', 'Api\RolesController@store');
        });

        Route::group([
            'prefix' => 'permissions',
            'middleware' => 'jwt'
        ], function () {
            Route::get('/{id}', 'Api\PermissionsController@edit');
            Route::put('/{id}', 'Api\PermissionsController@update');
            Route::delete('/{id}', 'Api\PermissionsController@destroy');
            Route::get('/', 'Api\PermissionsController@index');
            Route::post('/', 'Api\PermissionsController@store');
            Route::post('/assigntorole', 'Api\PermissionsController@assignPermissionToRole');
            Route::post('/multitorole', 'Api\PermissionsController@assignMultiplePermissionToRole');
            Route::post('/revokepermission', 'Api\PermissionsController@revokePermissionToRole');
            Route::post('/revokemultipermssion', 'Api\PermissionsController@revokeMultiplePermissionToRole');



        });
