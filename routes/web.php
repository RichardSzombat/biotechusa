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


Route::get('/',
    [
        'as' =>'index',
        'uses' => 'ProductController@index'
    ]);

Route::get('/product/create',
    [
        'as' =>'product.create',
        'uses' => 'ProductController@create'
    ]);

Route::post('/product/store',
    [
        'as' =>'product.store',
        'uses' => 'ProductController@store'
    ]);

Route::get('/product/{id}/edit',
    [
        'as' =>'product.edit',
        'uses' => 'ProductController@edit'
    ]);

Route::put('/product/{id}/update',
    [
        'as' =>'product.update',
        'uses' => 'ProductController@update'
    ]);

Route::delete('product/{id}/delete',
    [
       'as' => 'product.delete',
       'uses' => 'ProductController@destroy'
    ]);
