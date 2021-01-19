<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('frontend.home');
//});

Route::group(['namespace'=>'Frontend'], function (){
    Route::get('/','HomeController@showHomePage')->name('frontend.home');
    Route::get('/product/{slug}','ProductController@showDetails')->name('product.details');
});



