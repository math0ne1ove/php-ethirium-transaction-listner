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

Route::get('/', 'WalletController@index')->name('wallet');

Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function () {
    Route::get('/create', 'WalletController@create')->name('create');
    Route::post('/store', 'WalletController@store')->name('store');
    Route::get('{wallet}/delete', 'WalletController@delete')->name('delete');
});

Route::group(['prefix' => 'transactions', 'as' => 'transaction.'], function () {
    Route::get('/', 'TransactionController@index')->name('index');
    Route::get('/list', 'TransactionController@newList')->name('list');
});
