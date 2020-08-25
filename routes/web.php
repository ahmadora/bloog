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

//Route::get('/deviceService', 'Tenant\TenantDeviceController@service')->name('deviceServices');////user


Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function () {

    Route::get('/active', 'Tenant\TenantCustomerController@active')->name('activeAccount');
    Route::post('/active', 'Tenant\TenantCustomerController@activeAccount')->name('active');
    Route::get('/deviceService', 'Tenant\TenantDeviceController@service')->name('deviceService');
    Route::get('/screenService', 'ScreenController@index')->name('screenService');
    Route::get('/Advertisements', 'ImageController@index')->name('Advertisements');
    Route::get('/showImage','ImageController@show')->name('showImages');
    Route::post("/destroy/{id}","ImageController@delete")->name('destroy');

        Route::middleware('isTenant')->group(function () {
            Route::post('/show', 'Tenant\TenantCustomerController@saveNewUser');////tenant
            Route::post('/deleteUser', 'Tenant\TenantCustomerController@delete')->name('deleteUser');
            Route::get('/', 'HomeController@index')->name('index');
//            Route::get('/home', 'HomeController@index')->name('home');
            Route::get('/createCustomer', 'Tenant\TenantController@create')->name('createCustomer');///tenant
            Route::post('/create', 'Tenant\TenantController@store')->name('soso');
            Route::get('/showCustomer', 'Tenant\TenantCustomerController@show')->name('showCustomerUser');
            Route::post('/createCustomer', 'Tenant\TenantController@store')->name('create');////tenant/
            Route::get('/showUser', 'Tenant\TenantController@show')->name('showUsers');///tenant
            Route::get('/getToken', 'HomeController@userLogin')->name('takeToken');////tenant
           //tenant
            Route::get('/service', 'Tenant\TenantController@service')->name('tenantServices');////tenant
            Route::get('/getToken', 'HomeController@userLogin')->name('takeToken');////tenant
            Route::post('/getToken', 'HomeController@userLogin')->name('takeToken');////tenant
            Route::get('/createDevice', 'Tenant\TenantDeviceController@index')->name('createDevice');

            Route::get('/showScreen', 'ScreenController@show');
            Route::get("/createScreen", "ScreenController@create")->name("createScreen");

            Route::get('/show', 'Tenant\TenantDeviceController@show')->name('showDevices');
            Route::post('/updateDevices', 'Tenant\TenantDeviceController@update');
            Route::post('/showDevices', 'Tenant\TenantDeviceController@store')->name('storeDevice');
            Route::post('/updateScreen', 'ScreenController@update');
            Route::post('/editScreen', 'ScreenController@edit');
            Route::post('/createDevice', 'Tenant\TenantDeviceController@create');
        });

    //TODO User

        Route::middleware('ActiveUser')->group(function () {
//            Route::get('/home', 'HomeController@index')->name('userHome');
//            Route::get("/createScreen", "ScreenController@create")->name("createScreen");
            Route::post("/Screen", "ScreenController@store")->name("screen");
            Route::get("/upload", "ImageController@create")->name('upload');
            Route::post("/image", "ImageController@store")->name('image');

            //user

        });


});



