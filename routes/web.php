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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {

    Route::get('properties', 'PropertyController@index')->name('properties.index');
    Route::post('properties', 'PropertyController@store')->name('properties.store');
    Route::get('properties/create', 'PropertyController@create')->name('properties.create');
    Route::put('properties/{property}', 'PropertyController@update')->name('properties.update');
    Route::delete('properties/{property}', 'PropertyController@destroy')->name('properties.destroy');
    Route::get('properties/{property}', 'PropertyController@show')->name('properties.show');
    Route::get('properties/{property}', 'PropertyController@edit')->name('properties.edit');

    Route::get('tenants', 'TenantController@index')->name('tenants.index');
    Route::post('tenants', 'TenantController@store')->name('tenants.store');
    Route::get('tenants/create', 'TenantController@create')->name('tenants.create');
    Route::put('tenants/{tenant}', 'TenantController@update')->name('tenants.update');
    Route::delete('tenants/{tenant}', 'TenantController@destroy')->name('tenants.destroy');
    Route::get('tenants/{tenant}', 'TenantController@show')->name('tenants.show');
    Route::get('tenants/{tenant}', 'TenantController@edit')->name('tenants.edit');

    Route::get('tenancies', 'TenancyController@index')->name('tenancies.index');
    Route::post('tenancies', 'TenancyController@store')->name('tenancies.store');
    Route::get('tenancies/create', 'TenancyController@create')->name('tenancies.create');
    Route::put('tenancies/{tenancy}', 'TenancyController@update')->name('tenancies.update');
    Route::delete('tenancies/{tenancy}', 'TenancyController@destroy')->name('tenancies.destroy');
    Route::get('tenancies/{tenancy}', 'TenancyController@show')->name('tenancies.show');
    Route::get('tenancies/{tenancy}', 'TenancyController@edit')->name('tenancies.edit');

});

