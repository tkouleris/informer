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

Route::get('/', function () {
    if (Auth::check()) return redirect('newsfeed');

    return view('auth.login');
});

Auth::routes();

Route::get('/newsfeed', 'NewsfeedController@index')->name('newsfeed');
Route::get('/settings', 'SettingsController@settingsPage')->name('settings');
Route::get('/settings/categories/{country_id}', 'SettingsController@country_categories')->name('country_categories');
Route::post('/settings/categories/set', 'SettingsController@set_category_for_country')->name('set_category_for_country');

Route::post('image-upload', 'ImageController@ImageUpload')->name('image.upload');

Route::post('/settings/update-password', 'UpdatePasswordController@update')->name('settings.update.password');
