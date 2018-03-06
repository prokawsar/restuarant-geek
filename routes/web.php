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
    $users = \App\User::all();

    return view('welcome')->with('users', $users);
});

Auth::routes();

Route::get('/ucode', 'HomeController@getUCode')->name('ucode');
Route::post('/ucode', 'HomeController@setUCode');

Route::get('/kitchen/ucode', 'HomeController@setCode')->name('kcode');
Route::post('/kitchen/ucode', 'HomeController@setKitchenCode');

Route::get('/allorder', 'HomeController@showOrder')->name('allorder');

Route::get('/allitem', 'ItemController@show')->name('allitem');

Route::get('/additem', 'ItemController@addFormShow')->name('additem');

Route::post('/additem', 'ItemController@addItem');

Route::post('/updateitem', 'ItemController@updateItem');
Route::get('/edititem{id}', 'ItemController@edit')->name('edititem');
Route::get('/deleteitem{id}', 'ItemController@deleteItem')->name('deleteitem');

Route::get('/addcategory', 'ItemController@setCategory')->name('addcate');

Route::post('/addcategory', 'ItemController@addCategory');
Route::get('/delcategory{id}', 'ItemController@delCategory');

Route::get('/customer', 'HomeController@viewCustomer')->name('mycustomer');

Route::get('/alltable', 'TableController@show')->name('allTable');
Route::post('/addtable', 'TableController@addTable');
Route::get('/addtable','TableController@addTableForm' )->name('addTable');

Route::get('/deletetable{id}', 'TableController@deleteTable')->name('deleteTable');

Route::get('/allreview', 'HomeController@viewReview')->name('allreview');

Route::get('/kitchen', 'HomeController@viewKitchen')->name('kitchen');

Route::get('/sms', 'HomeController@smsCampaign')->name('smscamp');
Route::get('/emailcamp', 'HomeController@emailCampaign')->name('emailcamp');

Route::get('/billpaid{id}', 'HomeController@billPaid');

Route::post('/placeorder', 'WaiterController@placeOrder');

Route::get('/profile', 'HomeController@profile')->name('profile');

Route::post('/profile/edit', 'HomeController@editForm')->name('editprofile');

Route::post('/profile', 'HomeController@updateProfile');

Route::get('/setting', function(){
    return view('owner.setting');
})->name('setting');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'waiter'], function () {
  Route::get('/login', 'WaiterAuth\LoginController@showLoginForm')->name('wlogin');
  Route::post('/login', 'WaiterAuth\LoginController@login');
  Route::post('/logout', 'WaiterAuth\LoginController@logout')->name('wlogout');

  Route::get('/makeorder', 'WaiterController@index')->name('makeorder');
  Route::get('/placedorder', 'WaiterController@placedOrder')->name('placedorder');

  Route::post('/checkemail',['uses'=>'WaiterController@checkEmail']);
  Route::get('/moreitem{id}', 'WaiterController@addMoreItem')->name('moreitem');

  Route::get('/takereview', 'WaiterController@takeReview')->name('review');

  Route::post('/takereview', 'WaiterController@saveReview');

  Route::get('/getnotify', 'WaiterController@getNotification')->name('getnotify');
});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('alogin');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('alogout');

  Route::get('/home', function () {
    return view('admin.home');
  })->name('ahome');

});


Route::group(['prefix' => 'kitchen'], function () {
  Route::get('/login', 'KitchenAuth\LoginController@showLoginForm')->name('klogin');
  Route::post('/login', 'KitchenAuth\LoginController@login');
  Route::post('/logout', 'KitchenAuth\LoginController@logout')->name('klogout');
  Route::get('/home', 'KitchenController@index')->name('khome');
  Route::get('/allorders', 'KitchenController@orderData')->name('allorders');

  Route::get('/orderdone{id}', 'KitchenController@OrderDone')->name('orderdone');
  Route::get('/itemdone{id}', 'KitchenController@ItemDone')->name('itemdone');

});
