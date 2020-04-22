<?php

/*This link will add session of language when they click to change language*/

//Route::get('locale/{locale}', function ($locale) {
/*Session::put('locale',$locale);*/

// return back();
//});


Route::get('locale/{locale?}',
    [
        'as' => 'locale.setlocale',
        'uses' => 'LocaleController@setLocale'
    ]);


Route::get('/', 'MainController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {

    Route::get('properties', 'PropertyController@index')->name('properties.index');
    Route::get('properties/create', 'PropertyController@create')->name('properties.create');
    Route::post('properties', 'PropertyController@store')->name('properties.store');
    Route::get('properties/{property}', 'PropertyController@show')->name('properties.show');
    Route::get('properties/{property}/edit', 'PropertyController@edit')->name('properties.edit');
    Route::put('properties/{property}', 'PropertyController@update')->name('properties.update');
    Route::delete('properties/{property}', 'PropertyController@destroy')->name('properties.destroy');

    Route::get('tenants', 'TenantController@index')->name('tenants.index');
    Route::get('tenants/create', 'TenantController@create')->name('tenants.create');
    Route::post('tenants', 'TenantController@store')->name('tenants.store');
    Route::get('tenants/{tenant}', 'TenantController@show')->name('tenants.show');
    Route::get('tenants/{tenant}/edit', 'TenantController@edit')->name('tenants.edit');
    Route::put('tenants/{tenant}', 'TenantController@update')->name('tenants.update');
    Route::delete('tenants/{tenant}', 'TenantController@destroy')->name('tenants.destroy');

    Route::get('tenancies', 'TenancyController@index')->name('tenancies.index');
    Route::get('tenancies/create', 'TenancyController@create')->name('tenancies.create');
    Route::post('tenancies', 'TenancyController@store')->name('tenancies.store');
    Route::get('tenancies/{tenancy}', 'TenancyController@show')->name('tenancies.show');
    Route::get('tenancies/{tenancy}/edit', 'TenancyController@edit')->name('tenancies.edit');
    Route::put('tenancies/{tenancy}', 'TenancyController@update')->name('tenancies.update');
    Route::delete('tenancies/{tenancy}', 'TenancyController@destroy')->name('tenancies.destroy');

    Route::get('currency/converter', 'ConverterController@index')->name('currency.converter');

});

Route::get('/excel/export', 'ExcelController@export');
Route::get('/excel/import', 'ExcelController@import');

/*Route::get('/send/lastTenProperties', 'PropertyController@sendLastTenProperties');*/
