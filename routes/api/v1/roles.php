<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'roles',
    'middleware' => 'jwt',

], function () {
    Route::get('/{id}', 'Api\RolesController@edit');
    Route::put('/', 'Api\RolesController@update');
    Route::delete('/', 'Api\RolesController@destroy');
    Route::get('/', 'Api\RolesController@index');
    Route::post('/', 'Api\RolesController@store');
});

Route::group([
    'prefix' => 'permissions',
    'middleware' => 'jwt'
], function () {
    Route::get('/{id}', 'Api\PermissionsController@edit');
    Route::put('/', 'Api\PermissionsController@update');
    Route::delete('/', 'Api\PermissionsController@destroy');
    Route::get('/', 'Api\PermissionsController@index');
    Route::post('/', 'Api\PermissionsController@store');
    Route::post('/assigntorole', 'Api\PermissionsController@assignPermissionToRole');
    Route::post('/multitorole', 'Api\PermissionsController@assignMultiplePermissionToRole');
    Route::post('/revokepermission', 'Api\PermissionsController@revokePermissionToRole');
    Route::post('/revokemultipermssion', 'Api\PermissionsController@revokeMultiplePermissionToRole');
});
