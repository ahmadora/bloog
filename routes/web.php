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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/tenant', 'Tenant\TenantController@index');///tenant
Route::get('/getToken', 'HomeController@userLogin')->name('takeToken');////tenant
Route::get('/create', 'Tenant\TenantController@create');///tenant
Route::get('/show', 'Tenant\TenantController@show')->name('showUsers');///tenant
Route::get('/service', 'Tenant\TenantController@service')->name('tenantServices');////tenant
Route::post('/createCustomer', 'Tenant\TenantController@createCustomer')->name('createCustomer');////tenant
Route::post('/show', 'Tenant\TenantCustomerController@saveNewUser');////tenant
//Route::post('/show', 'Tenant\TenantCustomerController@delete');////tenant
Route::get('/showCustomer','Tenant\TenantCustomerController@show')->name('showCustomerUser');
Route::post('/deleteUser','Tenant\TenantCustomerController@delete')->name('deleteUser');

Route::middleware('auth')->group(function () {
    Route::prefix('tenant')->group(function () {
//        Route::get('/', 'Tenant\TenantController@index');///tenant
//        Route::get('/getToken', 'HomeController@userLogin')->name('takeToken');////tenant
//        Route::get('/home', 'HomeController@index')->name('home');
//        Route::get('/create', 'Tenant\TenantController@create');///tenant
//        Route::get('/show', 'Tenant\TenantController@show');///tenant
//        Route::get('/service', 'Tenant\TenantController@service')->name('tenantServices');////tenant
//        Route::post('/createCustomer', 'Tenant\TenantController@createCustomer')->name('createCustomer');////tenant
//        Route::get('/home', 'HomeController@index')->name('home');
//        Route::get('/showCustomer','Tenant\TenantCustomerController@show')->name('showCustomerUser');

    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('device')->group(function () {
        Route::get('/create', 'Tenant\TenantDeviceController@index');
        Route::post('/createDevice','Tenant\TenantDeviceController@create')->name('createDevice');
        Route::get('/show','Tenant\TenantDeviceController@show')->name('showDevices');
        Route::post('/showDevices','Tenant\TenantDeviceController@store')->name('storeDevice');
        Route::post('/updateDevices','Tenant\TenantDeviceController@update');
//        Route::get('/show','Tenant\TenantDeviceController@edit')->name('edit');

    });
});

