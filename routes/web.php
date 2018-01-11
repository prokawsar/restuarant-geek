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

Route::get('/makeorder', 'WaiterAuth\LoginController@showLoginForm')->name('wlogin');

Auth::routes();

Route::get('/ucode', function(){
    return view('owner.ucode');
})->name('ucode');

Route::get('/allitem', function(){
    return view('item.allitem');
})->name('allitem');

Route::get('/allreview', function(){
    return view('owner.allreview');
})->name('allreview');

Route::get('/kitchen', function(){
    return view('kitchen');
})->name('kitchen');

Route::get('/profile', function(){
    return view('owner.profile');
})->name('profile');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'waiter'], function () {
  Route::get('/login', 'WaiterAuth\LoginController@showLoginForm')->name('wlogin');
  Route::post('/login', 'WaiterAuth\LoginController@login');
  Route::post('/logout', 'WaiterAuth\LoginController@logout')->name('wlogout');

  Route::get('/takereview', function(){
    return view('review');
  })->name('review');

});
