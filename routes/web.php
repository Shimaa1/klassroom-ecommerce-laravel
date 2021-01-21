<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('frontend.home');
//});

Route::group(['namespace'=>'Frontend'], function (){
    Route::get('/','HomeController@showHomePage')->name('frontend.home');
    Route::get('/product/{slug}','ProductController@showDetails')->name('product.details');
    Route::get('/show/cart','CartController@showCart')->name('cart.show');
    Route::post('/add/to/cart','CartController@addToCart')->name('cart.add');
    Route::post('/cart/remove','CartController@removeFromCart')->name('cart.remove');
    Route::get('/cart/clear','CartController@clearCart')->name('cart.clear');
});



