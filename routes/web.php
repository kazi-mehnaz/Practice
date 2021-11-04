<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//Frontend Controller
Route::get('/', 'App\Http\Controllers\FrontendController@index');
Route::get('/create', 'App\Http\Controllers\FrontendController@createproduct');
Route::post('/create/post', 'App\Http\Controllers\FrontendController@createproductpost');
Route::get('/view', 'App\Http\Controllers\FrontendController@view_product');
Route::get('/product/details/{product_id}', 'App\Http\Controllers\FrontendController@productdetails');
Route::get('/shop', 'App\Http\Controllers\FrontendController@shop');

//contact, about Controller
Route::get('/about', 'App\Http\Controllers\FrontendController@about');
Route::get('/contact', 'App\Http\Controllers\FrontendController@contact');
Route::post('/contact/post', 'App\Http\Controllers\ContactController@contactpost');
Route::get('/contact/list', 'App\Http\Controllers\ContactController@index');

Auth::routes(); //Login, Register, Forget Password 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Category Controller
Route::get('/add/category', 'App\Http\Controllers\CategoryController@addcategory');
Route::post('/add/category/post', 'App\Http\Controllers\CategoryController@addcategorypost');

Route::get('/update/category/{category_id}', 'App\Http\Controllers\CategoryController@updatecategory');
Route::post('/update/category/post', 'App\Http\Controllers\CategoryController@updatecategorypost');
Route::get('/delete/category/{category_id}', 'App\Http\Controllers\CategoryController@deletecategory');
Route::get('/restore/category/{category_id}', 'App\Http\Controllers\CategoryController@restorecategory');
Route::get('/harddelete/category/{category_id}', 'App\Http\Controllers\CategoryController@harddeletecategory');

//Profile Controller
Route::get('/profile', 'App\Http\Controllers\ProfileController@index');
Route::post('/profile/post', 'App\Http\Controllers\ProfileController@profilepost');
Route::post('/password/post', 'App\Http\Controllers\ProfileController@passwordpost');

//Product Controller
Route::get('/add/product', 'App\Http\Controllers\ProductController@addproduct');
Route::post('/add/product/post', 'App\Http\Controllers\ProductController@addproductpost');

//Cart Controller
Route::get('/cart', 'App\Http\Controllers\CartController@cart');
Route::post('/add/to/cart', 'App\Http\Controllers\CartController@addtocart');
Route::get('/cart/delete/{cart_id}', 'App\Http\Controllers\CartController@cartdelete');
Route::post('/cart/update', 'App\Http\Controllers\CartController@cartupdate');

//Coupon Controller
Route::get('/add/coupon', 'App\Http\Controllers\CouponController@addcoupon');
Route::post('/add/coupon/post', 'App\Http\Controllers\CouponController@addcouponpost');
