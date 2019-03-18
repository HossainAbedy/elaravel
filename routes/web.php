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

// Route::get('/send/email', 'CheckoutController@mail');
Route::get('/verify/{token}', 'CheckoutController@verifyUser');
//frontend
Route::get('/', 'HomeController@index');
// Route::get('/search', 'HomeController@search');
// Route::get('/searchitem', 'HomeController@searchitem');

//show Homepage
Route::get('/product_by_category/{category_id}', 'HomeController@product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}', 'HomeController@product_by_manufacture');
Route::get('/view_product/{product_id}', 'HomeController@product_detail');

//cart routes
Route::post('/addtocart', 'CartController@addtocart');
Route::get('/showcart', 'CartController@showcart');
Route::get('/deletecart/{rowId}', 'CartController@deletecart');
Route::post('/updatecart', 'CartController@updatecart');

//checkout routes
Route::get('/loginuser', 'CheckoutController@loginuser');
Route::post('/customer_registration', 'CheckoutController@customer_registration');
Route::get('/checkout', 'CheckoutController@checkout');
//customer routes
Route::post('/customer_login', 'CheckoutController@customer_login');
Route::get('/customer_logout', 'CheckoutController@customer_logout');
//shipping routes
Route::post('/saveshippingdetails', 'CheckoutController@saveshippingdetails');
//payment
Route::get('/payment', 'CheckoutController@payment');
Route::post('/orderplace', 'CheckoutController@orderplace');
Route::get('/manageorder', 'CheckoutController@manageorder');//backend
Route::get('/view-order', 'CheckoutController@vieworder');//backend










//backend
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'SuperAdminController@index');
Route::get('/logout', 'SuperAdminController@logout');
Route::post('/admin-dashboard', 'AdminController@view_dashboard');



//catagory routes
Route::get('/addcategory', 'CategoryController@index');
Route::get('/allcategory', 'CategoryController@allcategory');
Route::get('/inactive/{category_id}', 'CategoryController@inactive');
Route::get('/active/{category_id}', 'CategoryController@active');
Route::get('/edit/{category_id}', 'CategoryController@edit');
Route::get('/delete/{category_id}', 'CategoryController@delete');
Route::post('/update/{category_id}', 'CategoryController@update');
Route::post('/savecategory', 'CategoryController@savecategory');


//manufacturer routes
Route::get('/addmanufacture', 'ManufactureController@index');
Route::get('/allmanufacture', 'ManufactureController@allmanufacture');
Route::get('/inactivem/{manufacture_id}', 'ManufactureController@inactive');
Route::get('/activem/{manufacture_id}', 'ManufactureController@active');
Route::get('/editm/{manufacture_id}', 'ManufactureController@edit');
Route::get('/deletem/{manufacture_id}', 'ManufactureController@delete');
Route::post('/updatem/{manufacture_id}', 'ManufactureController@update');
Route::post('/savemanufacture', 'ManufactureController@savemanufacture');

//product routes
Route::get('/allproducts', 'ProductsController@allproducts');
Route::get('/addproducts', 'ProductsController@index');
Route::get('/inactivep/{product_id}', 'ProductsController@inactive');
Route::get('/activep/{product_id}', 'ProductsController@active');
Route::get('/editp/{product_id}', 'ProductsController@edit');
Route::get('/deletep/{product_id}', 'ProductsController@delete');
Route::post('/updatep/{product_id}', 'ProductsController@update');
Route::post('/saveproducts', 'ProductsController@saveproducts');

//slider routes
Route::get('/allslider', 'SliderController@allslider');
Route::get('/addslider', 'SliderController@index');
Route::get('/inactives/{slider_id}', 'SliderController@inactive');
Route::get('/actives/{slider_id}', 'SliderController@active');
Route::get('/deletes/{slider_id}', 'SliderController@delete');
Route::post('/saveslider', 'SliderController@saveslider');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
