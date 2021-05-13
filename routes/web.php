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
//Fontend
Route::get('/', 'HomeController@index');
Route::get('/trangchu', 'HomeController@index');

//Danh mục ở trang chủ
Route::get('/danh-muc/{maloai}', 'CategoryProductController@show_category_home');
Route::get('/thuong-hieu/{math}', 'BrandProductController@show_brand_home');
Route::get('/chi-tiet-san-pham/{masp}', 'ProductController@details_product');

//Backend
Route::get('/admin', 'AdminController@login');
Route::get('/admin_index', 'AdminController@admin_index');
Route::post('/admin_login', 'AdminController@admin_login');
Route::get('/logout', 'AdminController@logout');

//Category product
Route::get('/add-category-product', 'CategoryProductController@add_category_product');
Route::get('/edit-category-product/{maloai}', 'CategoryProductController@edit_category_product');
Route::get('/delete-category-product/{maloai}', 'CategoryProductController@delete_category_product');
Route::get('/unactive-category-product/{maloai}', 'CategoryProductController@unactive_category_product');
Route::get('/active-category-product/{maloai}', 'CategoryProductController@active_category_product');
Route::get('/all-category-product', 'CategoryProductController@all_category_product');
Route::post('/save-category-product', 'CategoryProductController@save_category_product');
Route::post('/update-category-product/{maloai}', 'CategoryProductController@update_category_product');

//BrandProduct
Route::get('/add-brand-product', 'BrandProductController@add_brand_product');
Route::get('/edit-brand-product/{math}', 'BrandProductController@edit_brand_product');
Route::get('/unactive-brand-product/{math}', 'BrandProductController@unactive_brand_product');
Route::get('/active-brand-product/{math}', 'BrandProductController@active_brand_product');
Route::get('/delete-brand-product/{math}', 'BrandProductController@delete_brand_product');
Route::get('/all-brand-product', 'BrandProductController@all_brand_product');
Route::post('/save-brand-product', 'BrandProductController@save_brand_product');
Route::post('/update-brand-product/{math}', 'BrandProductController@update_brand_product');

//Product
Route::get('/add-product', 'ProductController@add_product');
Route::get('/edit-product/{masp}', 'ProductController@edit_product');
Route::get('/unactive-product/{masp}', 'ProductController@unactive_product');
Route::get('/active-product/{masp}', 'ProductController@active_product');
Route::get('/delete-product/{masp}', 'ProductController@delete_product');
Route::get('/all-product', 'ProductController@all_product');
Route::post('/save-product', 'ProductController@save_product');
Route::post('/update-product/{masp}', 'ProductController@update_product');

//Staff
Route::get('/add-staff', 'StaffController@add_staff');
Route::get('/edit-staff/{manv}', 'StaffController@edit_staff');
Route::get('/delete-staff/{manv}', 'StaffController@delete_staff');
Route::get('/all-staff', 'StaffController@all_staff');
Route::post('/save-staff', 'StaffController@save_staff');
Route::post('/update-staff/{manv}', 'StaffController@update_staff');