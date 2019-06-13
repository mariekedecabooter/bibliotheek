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

/** FRONTEND */
Route::get('/', function () {
    return view('welcome');

});

Route::get('/search', 'FrontController@search');
Route::get('/record/{record}', 'FrontController@record');


Route::get('/user/{user}', 'FrontController@user');


Auth::routes();

/** BACKEND  */
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'HomeController@index');

    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/roles', 'AdminRolesController');
    Route::resource('admin/addresses', 'AdminAddressController');
    Route::resource('admin/records', 'AdminRecordController');
    Route::resource('admin/authors', 'AdminAuthorController');
    Route::resource('admin/rentals', 'AdminRentalController');
});
