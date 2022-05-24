<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



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

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index');
        Route::get('/trades/myTrades', 'TradeController@myTrades')->name('trades.myTrades');
        Route::get('/price', 'CoinController@getCoins');
        Route::post('/slugger', 'CoinController@slugger');
        Route::post('/tradeslug', 'TradeController@slugger');
        Route::get('/search', 'CoinController@search');
        Route::resource('/trades', 'TradeController');
        Route::resource('/coins', 'CoinController');
    });
