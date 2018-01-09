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
    if(Auth::check()){
        return view('owner.home');
    }
    return view('welcome');
});

Route::get('makeorder', function(){
    return view('makeorder');
})->name('makeorder');

Route::get('takereview', function(){
    return view('review');
})->name('review');

Auth::routes();

Route::get('/kitchen', function(){
    return view('kitchen');
})->name('kitchen');

Route::get('/profile', function(){
    return view('owner.profile');
})->name('profile');

Route::get('/home', 'HomeController@index')->name('home');
