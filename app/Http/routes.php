<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// API
Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {
    Route::group(['prefix' => 'sintegra'], function() {
        Route::get('/', 'Api\SintegraController@index');
        Route::post('/', 'Api\SintegraController@store');
        Route::delete('/{id}', 'Api\SintegraController@destroy');
    });
});

// Consultas
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return redirect('nova-consulta');
    });

    Route::get('/nova-consulta', function () {
        return view('consulta-nova');
    });

    Route::get('/consultas-salvas', 'Api\SintegraController@index');
});

// Login
Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@getLogout');