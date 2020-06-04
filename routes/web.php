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

Route::get('/admin', 'HomeController@index');

Route::resource('parameters', 'ParameterController');

Route::resource('users', 'UserController');

Route::resource('categories', 'CategoryController');

Route::resource('attributes', 'AttributeController');

Route::resource('products', 'ProductController');

Route::resource('orders', 'OrderController');

Route::resource('orderDetails', 'OrderDetailController');

Route::get('/', 'HomePageController@index')->name('index');;

Route::get('/brand/{id}', 'BrandShowController@index');

Route::get('/cat/{id}', 'CategoryShowController@index');

Route::get('/entity/{id}', 'EntityShowController@index');

Route::get('/prod/{id}', 'ProductShowController@index');

Route::resource('images', 'ImageController');

Route::resource('sections', 'SectionController');

Route::resource('payments', 'PaymentController');

Route::resource('roles', 'RoleController');

Route::resource('roleUsers', 'RoleUserController');

Route::post('/loginSite', array('as' => 'loginSite', 'uses' => 'Auth\LoginController@loginSite'));

Route::post('/loginAdmin', array('as' => 'loginAdmin', 'uses' => 'Auth\LoginController@loginAdmin'));

//Route::post('/register', array('as' => 'register', 'uses' => 'Auth\RegisterController@register'));

Route::get('/cat-orderby/{id}/orderBy/{orderby}', 'CategoryShowController@order');

Route::get('/myAccount/changePassword', array('as' => 'myAccount.changePassword', 'uses' => 'AccountController@changePassword'));

Route::post('/myAccount/updatePassword', array('as' => 'myAccount.updatePassword', 'uses' => 'AccountController@updatePassword'));

Route::resource('myAccount', 'AccountController');

Route::resource('countries', 'CountryController');

Route::resource('zones', 'ZoneController');

Route::resource('cities', 'CityController');

Route::resource('locations', 'LocationController');

Route::resource('addresses', 'AddressesController');

Route::resource('userAddresses', 'UserAddressController');

Route::resource('address', 'AddressController');

Route::get('address/zone/{zone}/cities', 'AddressController@getCitiesFromZone');

Route::get('address/city/{city}/locations', 'AddressController@getLocationsFromCity');

Route::get('/payment/getPayments', array('as' => 'payment.getPayments', 'uses' => 'PaymentController@getPayments'));

Route::post('/payment/getPayments', array('as' => 'payment.getPayments', 'uses' => 'PaymentController@getPayments'));

Route::resource('mailings', 'MailingController');

Route::resource('contact', 'ContactController');

Route::resource('entities', 'EntityController');

Route::resource('sectionEntities', 'SectionEntityController');

Route::resource('imageEntities', 'ImageEntityController');

Route::resource('sellers', 'SellerController');

Route::resource('sellerCategories', 'SellerCategoryController');

Route::resource('news', 'NewsController');

Route::resource('events', 'EventController');

Route::resource('attributeValues', 'AttributeValueController');

Route::resource('brands', 'BrandController');

Route::resource('brandCategories', 'BrandCategoryController');

Route::resource('sellerDays', 'SellerDayController');

Route::resource('sellerReservations', 'SellerReservationController');

Route::resource('attributeValueEntities', 'AttributeValueEntityController');

Route::resource('orderDetailAttributeValueEntities', 'OrderDetailAttributeValueEntityController');

Route::post('/seller/reservation', 'SellerShowController@reservation');

Route::post('/seller/reserve', 'SellerShowController@reserve')->middleware('auth');

$this->get('/verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');

Route::post('product.contact', 'ProductShowController@contact');
