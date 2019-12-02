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
Route::get('/test', 'PagesController@test');
Route::get('/actus', 'PagesController@actus');

// Actualities handling
Route::get('/actus/{id}', 'ActualitiesController@list')->where('id', '[0-9]+');
Route::get('/actusPhoto/{id}', 'ActualitiesController@getPhoto')->where('id', '[0-9]+');
Route::get('/actusPhoto/small/{id}', 'ActualitiesController@getMiniature')->where('id', '[0-9]+');
Route::get('/actusPhoto/medium/{id}', 'ActualitiesController@getMedium')->where('id', '[0-9]+');
Route::get('/actusPhoto/large/{id}', 'ActualitiesController@getLarge')->where('id', '[0-9]+');

// Categories handling
Route::get('/galerie', 'CategoriesController@list');
Route::get('/galerie/{displayId}', 'CategoriesController@getList')->where('displayId', '[0-9]+');

// Photos handling
Route::get('/photos', 'PhotosController@list');
Route::get('/photos/{id}', 'PhotosController@display')->where('id', '[0-9]+');
Route::get('/photo/{id}', 'PhotosController@getFile');
Route::get('/photo/small/{id}', 'PhotosController@getMiniature');
Route::get('/photo/medium/{id}', 'PhotosController@getMedium');
Route::get('/photo/large/{id}', 'PhotosController@getLarge');

// Baskets handling
Route::get('/basket/home/{photoId}', 'BasketsController@home')->middleware('checkAdmin');
Route::post('/basket/list/{photoId}', 'BasketsController@list')->middleware('checkAdmin');
Route::get('/basket/update/{photoId}/{quantity}', 'BasketsController@update')->middleware('checkAdmin');
Route::get('/basket/menu', 'BasketsController@menu');
Route::get('/basket/delete', 'BasketsController@delete');
Route::get('/basket/delete/item/{panierId}', 'BasketsController@deleteItem');
Route::post('/basket/confirm', 'BasketsController@confirm');

// Administrator interaction
Route::post('/galerie', 'AdminController@categoryStore')->middleware('checkAdmin');
Route::get('/galerie/create', 'AdminController@categoryCreate')->middleware('checkAdmin');
Route::get('/galerie/modify/{id}', 'AdminController@categoryModify')->where('id', '[0-9]+')->middleware('checkAdmin');
Route::post('/galerie/modify', 'AdminController@categoryUpdate')->middleware('checkAdmin');
Route::get('/galerie/delete/{id}', 'AdminController@delete')->where('id', '[0-9]+')->middleware('checkAdmin');

Route::get('/photos/create', 'AdminController@photoCreate')->middleware('checkAdmin');
Route::post('/photos/create', 'AdminController@photoStore')->middleware('checkAdmin');
Route::get('/photos/update/{id}', 'AdminController@photosUpdate')->where('id', '[0-9]+')->middleware('checkAdmin');
Route::post('/photos/update', 'AdminController@photoStore')->middleware('checkAdmin');
Route::get('/photos/delete/{id}', 'AdminController@photosDelete')->where('id', '[0-9]+')->middleware('checkAdmin');

Route::get('/actus/create', 'AdminController@actusCreate')->middleware('checkAdmin');
Route::post('/actus/create', 'AdminController@actusStore')->middleware('checkAdmin');
Route::get('/actus/update/{id}', 'AdminController@actusUpdate')->where('id', '[0-9]+')->middleware('checkAdmin');
Route::post('/actus/update', 'AdminController@actusStore')->middleware('checkAdmin');
Route::get('/actus/delete/{id}', 'AdminController@actusDelete')->where('id', '[0-9]+')->middleware('checkAdmin');
