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
//    return view('/homePage');
//});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('parameters', 'ParameterController');

Route::resource('users', 'UserController');

Route::resource('categories', 'CategoryController');

Route::resource('attributes', 'AttributeController');

Route::resource('products', 'ProductController');

Route::resource('orders', 'OrderController');

Route::resource('orderDetails', 'OrderDetailController');

Route::resource('categoryAttributes', 'CategoryAttributeController');

Route::resource('categoryProducts', 'CategoryProductController');

Route::get('/', 'HomePageController@index')->name('index');;

Route::get('/cat/{id}', 'CategoryShowController@index');

Route::get('/prod/{id}', 'ProductShowController@index');

Route::resource('images', 'ImageController');

Route::resource('imageCategories', 'ImageCategoryController');

Route::resource('imageProducts', 'ImageProductController');

Route::resource('sections', 'SectionController');

Route::resource('sectionCategories', 'SectionCategoryController');

Route::resource('sectionProducts', 'SectionProductController');

Route::resource('payments', 'PaymentController');

Route::get('/payment/getPayments', array('as' => 'payment.getPayments', 'uses' => 'PaymentController@getPayments'));

Route::post('/payment/getPayments', array('as' => 'payment.getPayments', 'uses' => 'PaymentController@getPayments'));

Route::resource('roles', 'RoleController');

Route::resource('roleUsers', 'RoleUserController');

Route::post('/loginSite', array('as' => 'loginSite', 'uses' => 'Auth\LoginController@loginSite'));

Route::post('/loginAdmin', array('as' => 'loginAdmin', 'uses' => 'Auth\LoginController@loginAdmin'));

//Route::post('/register', array('as' => 'register', 'uses' => 'Auth\RegisterController@register'));
