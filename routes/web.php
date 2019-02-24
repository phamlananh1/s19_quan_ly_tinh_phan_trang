<?php

Route::get('/', function () {
    return view('home');
});
//tao group route customers
Route::group(['prefix' => 'customers'], function () {
    Route::get('/','CustomerController@index')->name('customers.index');
    Route::get('/create','CustomerController@create')->name('customers.create');
    Route::post('/create','CustomerController@store')->name('customers.store');
    Route::get('/{id}/edit','CustomerController@edit')->name('customers.edit');
    Route::post('/{id}/edit','CustomerController@update')->name('customers.update');
    Route::get('/{id}/destroy','CustomerController@destroy')->name('customers.destroy');
    Route::get('/filter','CustomerController@filterByCity')->name('customers.filterByCity');
    Route::get('/search','CustomerController@search')->name('customers.search');
});
//tao group route cties
Route::group(['prefix' => 'cities'], function () {
    Route::get('/','CityController@index')->name('cities.index');
    Route::get('/create','CityController@create')->name('cities.create');
    Route::post('/create','CityController@store')->name('cities.store');
    Route::get('/{id}/edit','CityController@edit')->name('cities.edit');
    Route::post('/{id}/edit','CityController@store')->name('cities.store');
    Route::get('/{id}/delete','CityController@destroy')->name('cities.destroy');
});

