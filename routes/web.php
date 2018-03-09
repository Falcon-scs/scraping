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

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@searchPage');
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@searchPage')->name('home');
Route::post('/search', 'HomeController@search')->name('search');
// Route::post('/search', 'HomeController@test')->name('search');
Route::get('/getSalesVolumn', 'HomeController@getSalesVolumn')->name('getSalesVolumn');
Route::get('/MajorIndustryGroup', 'HomeController@MajorIndustryGroup')->name('MajorIndustryGroup');
Route::post('/getKeywordSICs', 'HomeController@getKeywordSICs')->name('getKeywordSICs');
Route::post('/getKeywordNAICS', 'HomeController@getKeywordNAICS')->name('getKeywordNAICS');
Route::post('/export/csv', 'HomeController@export')->name('export.csv');
