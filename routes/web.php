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

Route::get('/service', 'Tenant\TenantCustomerController@index')->name('customerService');////tenant

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {


    Route::get('/devices/{id}', 'Tenant\TenantCustomerController@showDevices')->name('Devices');


    Route::post('/UserInfo', 'Tenant\TenantCustomerController@showUsers')->name('info');
    Route::get('/active', 'Tenant\TenantCustomerController@active')->name('activeAccount');
    Route::post('/active', 'Tenant\TenantCustomerController@activeAccount')->name('active');
    Route::get('/deviceService', 'Tenant\TenantDeviceController@service')->name('deviceService');
    Route::get('/screenService', 'ScreenController@index')->name('screenService');
    Route::get('/Advertisements', 'ImageController@index')->name('Advertisements');
    Route::get('/showImage','ImageController@show')->name('showImages');
    Route::post("/destroyImage/{id}","ImageController@delete")->name('destroyImage');
    Route::get('/showScreen', 'ScreenController@show')->name('showScreen');
    Route::get("/telemetry/{id}","Tenant\TenantDeviceController@showTelemetry")->name('telemetry');
    Route::get("/telemetryData/{id}","Tenant\TenantDeviceController@getTelemetryData")->name('telemetryData');


    Route::middleware('isTenant')->group(function () {
        Route::prefix('customer')->group(function (){
            Route::get('/show', 'Tenant\TenantCustomerController@show')->name('showCustomerUser');
            Route::get('/create', 'Tenant\TenantController@create')->name('createCustomer');///tenant
            Route::post('/create', 'Tenant\TenantController@store')->name('create');////tenant
            Route::get('/service', 'Tenant\TenantCustomerController@index')->name('customerService');////tenant


        });
        Route::prefix('screen')->group(function (){
            Route::get("/createScreen", "ScreenController@create")->name("createScreen");
            Route::post('/updateScreen', 'ScreenController@update')->name('updateScreen');
            Route::post("/destroy/{id}","ScreenController@destroy")->name('destroy');
            Route::post('/editScreen', 'ScreenController@edit')->name('editScreen');
            Route::post('/assign', 'ScreenController@assign');
            Route::post("/Screen", "ScreenController@store")->name("screen");
        });
            Route::post('/show', 'Tenant\TenantCustomerController@saveNewUser');////tenant
            Route::post('/deleteUser', 'Tenant\TenantCustomerController@delete')->name('deleteUser');
            Route::post('/create', 'Tenant\TenantController@store')->name('soso');
            Route::get('/', 'HomeController@index')->name('index');
            Route::get('showUser','Tenant\TenantController@show')->name('userShow');
            Route::get('/getToken', 'HomeController@userLogin')->name('takeToken');////te
            Route::get('/createDevice', 'Tenant\TenantDeviceController@index')->name('createDevice');

            Route::get('/show', 'Tenant\TenantDeviceController@show')->name('showDevices');
            Route::post('/updateDevices', 'Tenant\TenantDeviceController@update');
            Route::post('/showDevices', 'Tenant\TenantDeviceController@store')->name('storeDevice');
            Route::post('/createDevice', 'Tenant\TenantDeviceController@create');
        });

    //TODO User

        Route::middleware('ActiveUser')->group(function () {
            Route::get("/upload", "ImageController@create")->name('upload');
            Route::post("/image", "ImageController@store")->name('image');
            Route::get('/service','ScreenController@index')->name('screenService');
        });


});



