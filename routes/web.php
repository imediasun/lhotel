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
Auth::routes();
Route::get('/', 'MainController@index');
/*Route::get('/admin', 'AdminController@index');
Route::get('/admin/customers_managment', 'AdminController@customers_managment');
Route::get('/admin/add_good', 'AdminController@add_good');
Route::get('/admin/add_logos', 'AdminController@add_logos');
Route::get('/admin/del_good', 'AdminController@del_good');*/
/*Route::get('/', function () {
    return view('index');
});*/

Route::get('/session',function(){

    dd(csrf_token());
});
Route::get('/room/{id}', 'RoomController@index')->where('id', '[0-9]+');
Route::get('/photos_', 'PhotosController@index');
Route::get('/contacts', 'ContactsController@index');
Route::get('/article', 'ArticleController@index');
Route::post('/functions_images', 'FuncController@index');
Route::post('/functions_image', 'FuncController@main_image');
Route::post('/functions_image_update', 'FuncController@update_image');
Route::post('/functions_form', 'FuncController@form');
Route::post('/functions_form_logo', 'FuncController@form_logo');
Route::post('/functions_logo', 'FuncController@add_logo');
Route::get('/home', 'HomeController@index');
Route::get('/good/{id}', 'GoodController@index')->where('id', '[0-9]+')->name('good');
Route::get('/cabinet/{id}', 'PrivateCabinetController@index')->where('id', '[0-9]+');
Route::get('/cabinet/orders/{id}', 'PrivateCabinetController@orders')->where('id', '[0-9]+');
Route::get('/cabinet/likes/{id}', 'PrivateCabinetController@likes')->where('id', '[0-9]+');
Route::get('/cabinet/messages/{id}', 'PrivateCabinetController@messages')->where('id', '[0-9]+');
Route::get('/category/{id}', 'CategoryController@index')->where('id', '[0-9]+');
Route::post('/MainController/ajax_usersessions', 'MainController@ajax_usersessions');

Route::get('auth/facebook', 'FacebookController@redirectToProvider')->name('facebook.login');
Route::get('auth/facebook/callback', 'FacebookController@handleProviderCallback');
Route::get('/room_added', function () {

    return view('room');
})->name('room_added');
Route::get('/prices_added', function () {

    return view('prices');
})->name('prices_added');
/*Route::get('/good_added', function () {
    return view('partner');
})->name('partner_added');*/
Route::get('/not_yours', function () {
    return view('not_yours');
})->name('not_yours');

Route::get('/logout',['uses' => 'Admin\IndexController@index','as' => 'adminIndex']);

//admin
Route::group(['prefix' => 'admin','middleware'=>['web','auth']],function(){
       //admin

    Route::get('/',['uses' => 'Admin\IndexController@index','as' => 'adminIndex']);
    Route::post('/func_update_role', 'FuncController@role');
    Route::post('/func_delete_user', 'FuncController@delete_user');
    Route::post('/func_delete_room', 'FuncController@delete_room');
    Route::resource('/add_room','Admin\RoomsController');
    Route::get('/add_logos','Admin\PertnersController@add_logos');
    Route::get('/del_logos','Admin\PertnersController@del_logos');
    Route::get('/categories','Admin\CategoriesController@index');
    Route::get('/partners','Admin\PertnersController@index');
    Route::get('/add_category','Admin\CategoriesController@add_category');
    Route::get('/edit_room','Admin\RoomsController@edit_room_fasade');
    Route::get('/edit_room/{id}','Admin\RoomsController@edit_room');
    Route::get('/view_room/{id}','Admin\RoomsController@view_room');
    Route::get('/delete_rooms','Admin\GoodsController@delete_rooms');
    Route::get('/rooms_prices','Admin\RoomsController@rooms_prices');

    Route::get('/room_employment','Admin\RoomsController@room_employment');
    Route::get('/employ_room/{id}','Admin\RoomsController@employ_room');
    Route::post('/add_room_','FuncController@add_room');
    /*Route::post('/rooms_prices_','FunctionsController@rooms_prices');*/
    Route::post('/new_event','Admin\RoomsController@new_event');
    Route::post('/setting_room_price','Admin\RoomsController@setting_room_price');
    Route::resource('/customers_managment','Admin\CustomersController');
    Route::get('/garden','Admin\GardenController@index');
});


/*Route::get('sendmail','')*/
Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
Route::get('/add_to_cart/{id}','ShopingCartController@addToCart')->name('add_to_cart');
Route::get('/shoping_cart','ShopingCartController@getCart')->name('shoping_cart');
Route::get('/checkout','ShopingCartController@getCheckout')->name('checkout');
Route::post('/reserve','ReserveController@index')->name('reserve');
Route::post('/send_mail','ReserveController@send_mail')->name('send_mail');
Route::get('/delete_product_by_one/{id}','ShopingCartController@delete_product_by_one')->name('delete_product_by_one');
Route::get('/delete_products/{id}','ShopingCartController@delete_products')->name('delete_products');

Route::post('/add_comment','FuncController@addComment')->name('add_comment');
Route::post('/add_question_answer','FuncController@addQuestion_answer')->name('add_question_answer');
Route::post('/add_question','FuncController@addQuestion')->name('add_question');
Route::post('/delete_question','FuncController@deleteQuestion')->name('delete_question');
Route::post('/delete_logotype','FuncController@deleteLogotype');
Route::post('/delete_comment','FuncController@deleteComment')->name('delete_comment');
Route::post('/add_category','FuncController@addCategory')->name('add_category');
Route::post('/update_user_info','FuncController@update_user_info')->name('update_user_info');
Route::post('/update_customer_info','FuncController@update_customer_info')->name('update_customer_info');
Route::post('/func_change_status','FuncController@func_change_status');
Route::post('/func_like_change','FuncController@func_like_change');
Route::get('/func_like_delete/{id}/{user}','FuncController@func_like_delete')->name('func_like_delete');
Route::post('/get_calendar_data','Admin\RoomsController@get_calendar_data');
Route::post('/put_calendar_data','Admin\RoomsController@put_calendar_data');
Route::post('/delete_calendar_data','Admin\RoomsController@delete_calendar_data');















Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
