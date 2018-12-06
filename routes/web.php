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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('product', 'ProductController')->middleware('checkAuth');
Route::resource('supplier', 'SupplierController')->middleware('checkAuth');
Route::resource('bill', 'BillController')->middleware('checkAuth');
Route::resource('expence', 'ExpenceController')->middleware('checkAuth');
Route::resource('billproduct', 'BillProductController')->middleware('checkAuth');
Route::resource('billexpence', 'BillExpenceController')->middleware('checkAuth');
Route::get('test',function ()
{
 return view('test');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
