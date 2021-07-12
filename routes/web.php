<?php

use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
Route::get('/','ProductController@index')->name('home'); 
Route::get('/profile','BuyController@profile')->name('profile');    
Route::get('/buy/product/{product}', 'BuyController@buy')->name('buy');
Route::post('/buy/{product}', 'BuyController@makePayment')->name('make-payment');
Route::delete('/buy/{product}','BuyController@destroy')->name('cancel');  

Route::post('/profile','BuyController@store')->name('address');
Route::put('/profile/{card}','BuyController@update');

   
Auth::routes();
Route::get('/product','ProductController@index')->name('product.index');
Route::get('/product/{product}','ProductController@show')->name('product.show');

Route::get('/categorie/{categorie}','CategorieController@show')->name('categorie.show');


Route::prefix('/admin')->name('admin.')->group(function(){
    Route::get('/dashboard','Admin\HomeController@index')->name('home')->middleware('auth:admin');
    Route::get('/contact','Admin\HomeController@contact')->name('contact');
    //Login Routes
    Route::get('/login','Admin\Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login','Admin\Auth\LoginController@login');
    Route::post('/logout','Admin\Auth\LoginController@logout')->name('logout');

    Route::get('/register','Admin\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register','Admin\Auth\RegisterController@register');

    //Forgot Password Routes
    Route::get('/password/reset','Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email','Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}','Admin\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset','Admin\Auth\ResetPasswordController@reset')->name('password.update');

    Route::resource('user', Admin\UserController::class);
    Route::resource('categorie', Admin\CategorieController::class);
    Route::resource('product',Admin\ProductController::class);
    route::post('/product/fill/{product}','Admin\ProductController@fillup');
    Route::resource('buy',Admin\BuyController::class);
    Route::post('buy/{product}','Admin\BuyController@approve');
   
    Route::post('/product/index/table', 'Admin\ProductController@index');
    Route::get('/product/index/table', 'Admin\ProductController@index');

    Route::post('/categorie/index/table', 'Admin\CategorieController@index');
    Route::get('/categorie/index/table', 'Admin\CategorieController@index');

    Route::post('/buy/index/table', 'Admin\BuyController@index');
    Route::get('/buy/index/table', 'Admin\BuyController@index');

    
  });
