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

Route::get('/', function() {
	return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/register', 'UserController@getcredentials')->name('register')->middleware('guest');
Route::post('/register', 'UserController@postCredentials')->name('register')->middleware('guest');
Route::get('/login', 'UserController@getUserInfo')->name('login')->middleware('guest');
Route::post('/login', 'UserController@postUserInfo')->name('login')->middleware('guest');

Route::get('/logout', 'UserController@logout')->name('logout')->middleware('auth');

Route::get('/add-to-cart/{id}', 'ProductController@getAddToCart')->name('addToCart')->middleware('auth');
Route::get('/Cart', 'ProductController@getCart')->name('Cart')->middleware('auth');
Route::get('/reduce/{id}', 'ProductController@getReduceByOne')->name('reduce')->middleware('auth');
Route::get('/drop/{id}', 'ProductController@getDropItem')->name('drop')->middleware('auth');

Route::get('/checkout', 'ProductController@getCheckout')->name('checkout')->middleware('auth');
Route::post('/checkout', 'ProductController@postCheckout')->name('checkout')->middleware('auth');

Route::get('/profile', 'UserController@getProfile')->name('profile')->middleware('auth');



