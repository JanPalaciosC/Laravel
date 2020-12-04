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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('contact', 'webController@contact')->name('contact');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'MovieController@dashboard')->name('dashboard');

Route::middleware(['auth'])->group(function(){
	
	Route::get('/movies', 'MovieController@index')->name('movies');
	Route::get('/movies-info/{movie}', 'MovieController@get');
	Route::post('/movies', 'MovieController@store');
	Route::put('/movies', 'MovieController@update');
	Route::delete('/movies/{movie}', 'MovieController@destroy');

	Route::get('/loans', 'LoanController@index')->name('loans');
	Route::get('/loan-info/{loan}', 'LoanController@get')->name('loan-info');
	Route::post('/loans', 'LoanController@store');
	Route::put('/loans', 'LoanController@update');

	Route::get('/return/{id}', 'LoanController@return');
	Route::get('/myLoans', 'LoanController@myloans');
});

Route::middleware(['roles'])->group(function(){

	Route::get('/categories', 'CategoryController@index')->name('categories');
	Route::post('/categories', 'CategoryController@store');
	Route::put('/categories', 'CategoryController@update');
	Route::delete('/categories/{category}', 'CategoryController@destroy');

});
