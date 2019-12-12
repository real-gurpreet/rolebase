<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group([
//     'prefix' => 'auth',
// ], function () {
//     Route::post('login', 'Api\AuthController@login');
//     Route::post('signup', 'Api\AuthController@signup');

//     Route::group([
//         'middleware' => 'auth:api',
//     ], function () {
//         Route::get('logout', 'Api\AuthController@logout');
//         Route::get('user', 'Api\AuthController@user');
//     });
// });

// 'middleware' => 'api',
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('signup', 'Api\AuthController@signup');
    Route::post('login', 'Api\AuthController@login');
});

Route::group([
    'prefix' => 'auth',
    'middleware' => 'jwt'
], function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');
    Route::post('/assign_roles', 'Api\AuthController@assignUserRoles');
    Route::post('/check_permission', 'Api\AuthController@checkPermission');


    // Route::put('/{id}', 'Api\PermissionsController@update');
    // Route::delete('/{id}', 'Api\PermissionsController@destroy');
    // Route::get('/', 'Api\PermissionsController@index');




});
