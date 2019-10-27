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

use App\Category;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Simple view returning => call PagesController
Route::get('/', 'PagesController@home')->middleware('rememberUrl');
Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@postcontact');
Route::get('/about', 'PagesController@about');
Route::get('/login', 'PagesController@login');
Route::get('/account', 'PagesController@register');
Route::get('/logout', 'PagesController@logout');

// Categories handling
Route::get('/galerie', 'CategoriesController@list');

// Photos handling
Route::get('/photos', 'PhotosController@list');
Route::get('/photo/{id}', 'PhotosController@getFile');
Route::get('/photo/small/{id}', 'PhotosController@getMiniature');
Route::get('/photo/medium/{id}', 'PhotosController@getMedium');
Route::get('/photo/large/{id}', 'PhotosController@getLarge');

// Baskets handling
Route::get('/basket/home/{photoId}', 'BasketsController@home')->middleware('checkAdmin');
Route::post('/basket/list/{photoId}', 'BasketsController@list')->middleware('checkAdmin');
Route::get('/basket/menu', 'BasketsController@menu');
Route::post('/basket/delete', 'BasketsController@delete');
Route::post('/basket/delete/item', 'BasketsController@deleteItem');

// Administrator interaction
Route::post('/galerie', 'AdminController@categoryStore')->middleware('checkAdmin');
Route::get('/galerie/create', 'AdminController@categoryCreate')->middleware('checkAdmin');
Route::post('/galerie/delete', 'AdminController@categoryDelete')->middleware('checkAdmin');

Route::get('/photos/create', 'AdminController@photoCreate')->middleware('checkAdmin');
Route::post('/photos/create', 'AdminController@photoStore')->middleware('checkAdmin');
