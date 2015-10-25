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
//api response
Route::get('/api', 'ApiController@index');
Route::post('/api', 'ApiController@index');
//homepage
Route::get('/', 'HomeController@index');
//return zip codes
Route::post('/zip', 'ZipController@index');
Route::get('/zip', 'ZipController@index');

