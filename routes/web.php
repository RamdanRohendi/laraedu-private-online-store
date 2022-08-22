<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function() {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/pencarian', 'HomeController@pencarian')->name('home.pencarian');

    Route::middleware(['guest'])->group(function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@index')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@index')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::middleware(['auth'])->group(function() {
        /**
         * Logout Routes
         */
        Route::post('/logout', 'LoginController@logout')->name('logout');

        /**
         * Profile Routes
         */
        Route::get('/profile', 'ProfileController@index')->name('user.profile');
        Route::post('/profile/update-foto', 'ProfileController@updateFoto')->name('user.profile.update-foto');
        Route::post('/profile/update-password', 'ProfileController@updatePassword')->name('user.profile.update-password');
        Route::delete('/profile/delete', 'ProfileController@delete')->name('user.profile.delete');

        Route::middleware(['role:admin'])->group(function () {
            Route::group(['namespace' => 'Master'], function() {
                /**
                 * User Routes
                 */
                Route::get('/users/data', 'UsersController@get_user')->name('users.data');
                Route::resource('users', 'UsersController');

                /**
                 * Product Routes
                 */
                Route::get('/products/data', 'ProductsController@getData')->name('products.data');
                Route::resource('products', 'ProductsController');
            });
        });
    });
});
