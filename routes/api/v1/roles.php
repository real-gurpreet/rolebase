<?php
        Route::get('roles/{id}', 'Api\RolesManager@edit');
        Route::put('roles/{id}', 'Api\RolesManager@update');
        Route::delete('roles/{id}', 'Api\RolesManager@destroy');
        Route::get('roles', 'Api\RolesManager@index');
        Route::post('roles', 'Api\RolesManager@store');

