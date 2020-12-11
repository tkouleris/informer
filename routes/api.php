<?php

use Illuminate\Http\Request;

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

Route::post('/login','ApiControllers\AuthController@login');


Route::group(['middleware' => ['jwt.auth']], function() {

    // newsfeed
    Route::get('/newsfeed','ApiControllers\NewsfeedController@feed');

    // settings
    Route::get('/settings','ApiControllers\SettingsController@settingsPage');
    Route::get('/settings/categories/{country_id}','ApiControllers\SettingsController@country_categories');
    Route::post('/settings/categories/set','ApiControllers\SettingsController@set_category_for_country');

    // upload user avatar
    Route::post('/avatar/upload','ApiControllers\ImageController@ImageUpload');

    // update password
    Route::post('/settings/update-password','ApiControllers\UpdatePasswordController@update');

});
