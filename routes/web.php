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
        $id = Auth::id();
        $data = App\Waiter::select('wCode', 'password')->where('rest_id', $id)->get();
        $data2 = App\Kitchen::select('kCode', 'password')->where('rest_id', $id)->get();
        //        dd($data);
        return view('owner.home', compact('data', 'data2'));
    }
    return view('welcome');
});

Auth::routes();

Route::get('/ucode', 'HomeController@getUCode')->name('ucode');
Route::post('/ucode', 'HomeController@setUCode');

Route::get('/kitchen/ucode', 'HomeController@setCode')->name('kcode');
Route::post('/kitchen/ucode', 'HomeController@setKitchenCode');

Route::get('/allitem', function(){
    return view('item.allitem');
})->name('allitem');

Route::get('/additem', function(){
    return view('item.add');
})->name('additem');

Route::post('/additem', 'ItemController@addItem');

Route::post('/updateitem', 'ItemController@updateItem');
Route::get('/edititem{id}', 'ItemController@edit')->name('edititem');
Route::get('/deleteitem{id}', 'ItemController@deleteItem')->name('deleteitem');

Route::get('/addcategory', function(){
    return view('item.addcate');
})->name('addcate');

Route::post('/addcategory', 'ItemController@addCategory');

Route::get('/customer', function(){
    return view('owner.customer');
})->name('mycustomer');

Route::get('/alltable', 'TableController@show')->name('allTable');
Route::post('/addtable', 'TableController@addTable');
Route::get('/addtable','TableController@addTableForm' )->name('addTable');

Route::get('/deletetable{id}', 'TableController@deleteTable')->name('deleteTable');

Route::get('/allreview', function(){
    return view('owner.allreview');
})->name('allreview');

Route::get('/kitchen', function(){
    return view('owner.kitchen');
})->name('kitchen');

Route::get('/profile', function(){
    return view('owner.profile');
})->name('profile');

Route::get('/setting', function(){
    return view('owner.setting');
})->name('setting');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'waiter'], function () {
  Route::get('/login', 'WaiterAuth\LoginController@showLoginForm')->name('wlogin');
  Route::post('/login', 'WaiterAuth\LoginController@login');
  Route::post('/logout', 'WaiterAuth\LoginController@logout')->name('wlogout');
  Route::get('/makeorder', 'WaiterController@index')->name('makeorder');

  Route::get('/takereview', 'WaiterController@takeReview')->name('review');

});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('alogin');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('alogout');

  Route::get('/home', function () {
    //dd($users);

    return view('admin.home');
  })->name('khome');

});


Route::group(['prefix' => 'kitchen'], function () {
  Route::get('/login', 'KitchenAuth\LoginController@showLoginForm')->name('klogin');
  Route::post('/login', 'KitchenAuth\LoginController@login');
  Route::post('/logout', 'KitchenAuth\LoginController@logout')->name('klogout');
  Route::get('/home', 'KitchenController@index')->name('khome');
 
});
