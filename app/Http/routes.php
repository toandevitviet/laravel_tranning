<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
//single 
Route::get('/', function () {
    return view('welcome single route');
    //return "Hello laravel";
});

//multi
Route::match(['get','post'], '/', function () {
   return "Multi match laravel"; 
});

//welcome default route
Route::get('/', function () {
    return view('welcome');
    //return "Hello laravel";
});

//any
Route::any('page', function() {
   return 'Page any'; 
});

//router parameters
Route::get('page/{id}', function($id) {
   return 'Page with parameter ' .$id; 
});

//view
Route::get('view', function() {
   return view('viewfile', ['data' => 'Toanlm view']); 
});


Route::get('user/{id}', 'TestController@showInfo');

//Route::put('user/{id}', 'TestController@update');

Route::get('upload', function() {
	return View::make('pages.upload');
});

Route::post('apply/upload', 'ApplyController@upload');

Route::get('account/login', function() {
  return View::make('pages.login');
});
Route::post('account/login', 'AccountController@login');
*/

//catalog package
Route::get('/', function() {
  return View::make('catalog.product');
});

//save product
Route::post('/save-product', 'productCurd@saveProduct');

//view list products
Route::get('/products', 'productCurd@products');

//delete product
Route::get('/delete/{id}','productCurd@delete');

//edit product
Route::get('/edit/{id}','productCurd@edit');
Route::patch('/edit/{id}', ['as' => 'product.update', 'uses' => 'productCurd@update']);

//show product
Route::get('product/{id}', 'productCurd@showProduct');

//search
Route::resource('/search-products', 'productCurd@search');