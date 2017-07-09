<?php

Route::get('/', 'PagesController@home');

// Route::get('/', function () {
//     return view('pages.home');
// });

// Authentication routes...

Route::resource('flyers', 'FlyersController');
Route::get('{zip}/{street}', 'FlyersController@show');
Route::post('{zip}/{street}/photos', 'PhotosController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/', 'HomeController@index');