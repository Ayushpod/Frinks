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

// Route::get('/me', function () {
//     return 'here goes test';
// })->middleware(['auth','role:admin,employee']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
  	Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::get('/users', 'AdminController@user')->name('admin.users');
});
