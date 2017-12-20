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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', [
	'uses' => 'ProductController@getProduct',
	'as' => 'showProduct'
]);

Route::get('/All', [
	'uses' => 'ProductController@getProductAll',
	'as' => 'showProductAll'
]);

Route::get('/category/{catName}/{subName}', [
	'uses' => 'ProductViewController@getCategory',
	'as' => 'getCategory'
]);

Route::get('/add-product', ['middleware' => 'admin',
	'uses' => 'ProductController@getAddProduct',
	'as' => 'addProduct'
]);

Route::post('/product-added', ['middleware' => 'admin',
	'uses' => 'ProductController@postAddProduct',
	'as' => 'postProduct'
]);

Route::post('/attribute-added', ['middleware' => 'admin',
	'uses' => 'ProductController@postAddAttribute',
	'as' => 'postAttribute'
]);

Route::post('/variance-added', ['middleware' => 'admin',
	'uses' => 'ProductController@postAddVariance',
	'as' => 'postVariance'
]);

Route::get('/all-products', ['middleware' => 'admin',
	'uses' => 'ProductEditController@getEditProducts',
	'as' => 'allProducts'
]);

Route::get('/edit-product/{productId}', ['middleware' => 'admin',
	'uses' => 'ProductEditController@getEditProduct',
	'as' => 'editProduct'
]);

Route::post('/edit-process', ['middleware' => 'admin',
	'uses' => 'ProductEditController@postEditProduct',
	'as' => 'editProcess'
]);

Route::post('/edit-attribute', ['middleware' => 'admin',
	'uses' => 'ProductEditController@postMoreAttribute',
	'as' => 'moreAttribute'
]);

Route::get('/product/{productId}', [
	'uses' => 'ProductViewController@getProduct',
	'as' => 'product'
]);

Route::get('/add-to-wishlist/{id}', 'WishlistController@addItem');
Route::get('/wishlist', 'WishlistController@showList')->middleware('admin');
Route::get('/wish-remove/{itemId}', 'WishlistController@removeWish');

//Route Cart By Sahriare
Route::get('/addProduct/{id}/{quantity}', 'CartController@addItem');
Route::get('/removeItem/{itemId}', 'CartController@removeItem');
Route::get('/cart', 'CartController@showCart');
Route::get('/checkout/{userId}', 'CartController@checkOut');

Route::get('/profile', 'CartController@profile');
Route::get('/edit-user-data/{userId}', 'CartController@editUserData');
//Taking the value from form of edit profile
Route::post('/user-data-post', 'CartController@getUserData');
Route::post('/post-checkout', 'CartController@getPostCheckOut');
Route::get('/cc', 'CartController@getCC');

Route::get('/orders', 'OrdersController@showOrders')->middleware('admin');
Route::get('/process-order/{orderId}', 'OrdersController@processOrder');
Route::get('/deliver-order/{orderId}', 'OrdersController@deliverOrder');
Route::get('/users', 'UserController@getUsers');


Route::post('/post-review', [
	'uses' => 'ProductViewController@postReview',
	'as' => 'postReview'
]);

Route::get('/query', 'ProductController@search');
Route::get('/special', 'ProductController@special');
Route::post('/special-post', 'ProductController@special');


Route::get('/customer', 'CustomerController@showAddCustomer');
Route::post('/customer-data-add', 'CustomerController@postCustomerData');
Route::get('/report-by-date/{time?}', 'ReportController@showReportByDate');
Route::post('/report-by-date-custom', 'ReportController@showReportByDate');
Route::get('/report-by-product', 'ReportController@showReportByProduct');
Route::get('/report-employees', 'ReportController@showReportEmployees');