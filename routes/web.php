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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/me', function () {
//     return 'here goes test';
// })->middleware(['auth','role:admin,employee']);

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/people', 'HomeController@index')->name('people');
Route::get('/about', 'HomeController@index')->name('about');
Route::get('/detail/{id}', 'HomeController@detail')->name('user.detail');

Route::middleware(['auth', 'role:employee'])->group(function () {
  	Route::get('/profile', 'ProfileController@index')->name('user.profile');
  	Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
  	Route::post('/profile/profile-pic', 'ProfileController@saveProfilePic')->name('user.profile.pic');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
  	Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::get('/users', 'AdminController@user')->name('admin.users');
    Route::get('/user/detail/{id}', 'AdminController@userDetail')->name('admin.user_detail');
    Route::get('/user/approve/{id}', 'AdminController@approve')->name('admin.user_approve');
});
