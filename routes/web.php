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
    return view('welcome');
});
Route::get('/loginmovil', function() {
    return view('movil.login');
});
Route::get('/search', function() {
    return view('movil.search');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');
Route::get('users.data', [
    'uses' => 'UsersController@data',
    'as' => 'users.data',
]);

Route::resource('customers', 'CustomersController');
Route::get('customers.data', [
    'uses' => 'CustomersController@data',
    'as' => 'customers.data',
]);
