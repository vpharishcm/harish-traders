<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login','AuthController@login');
Route::post('/register','AuthController@register');
Route::resource('product', 'Api\ProductController')->middleware('auth:api');
Route::resource('supplier', 'Api\SupplierController')->middleware('auth:api');
Route::resource('expence', 'Api\ExpenceController')->middleware('auth:api');
Route::resource('bill', 'Api\BillController')->middleware('auth:api');