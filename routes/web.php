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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/userLoginPage','User\UserLoginController@userLoginPage')->name('user.userLoginPage');
Route::get('/userLoginCheck','User\UserLoginController@userLoginCheck')->name('user.userLoginCheck');

Route::group(['middleware' => 'UserSess'], function () {

    Route::get('/userLogout','User\UserLoginController@userLogout')->name('user.userLogout');

    Route::get('/','User\UserController@index')->name('user.index');

    // Prodcut Brand

    Route::get('/prductBrandIndex','Product\ProductBrandController@prductBrandIndex')->name('user.prductBrandIndex');
    Route::get('/getAllbrand','Product\ProductBrandController@getAllbrand')->name('user.getAllbrand');
    Route::post('/insertBrand','Product\ProductBrandController@insertBrand')->name('user.insertBrand');
    Route::get('/updateData','Product\ProductBrandController@updateData')->name('user.updateData');
    Route::post('/updateDataStore','Product\ProductBrandController@updateDataStore')->name('user.updateDataStore');
    Route::post('/deleteData','Product\ProductBrandController@deleteData')->name('user.deleteData');

    // Product Category

    Route::get('/categoryIndex','Product\ProductCategoryController@categoryIndex')->name('user.categoryIndex');
    Route::get('/getAllCategoryData','Product\ProductCategoryController@getAllCategoryData')->name('user.getAllCategoryData');
    Route::post('/insertCategoryName','Product\ProductCategoryController@insertCategoryName')->name('user.insertCategoryName');
    Route::get('/updateCategory','Product\ProductCategoryController@updateCategory')->name('user.updateCategory');
    Route::post('/updateCategoryStore','Product\ProductCategoryController@updateCategoryStore')->name('user.updateCategoryStore');
    Route::post('/deleteCategory','Product\ProductCategoryController@deleteCategory')->name('user.deleteCategory');

    // Product Producer

    Route::get('/producerIndex','Product\ProductProducerCompanyController@producerIndex')->name('user.producerIndex');
    Route::get('/getAllProductCompany','Product\ProductProducerCompanyController@getAllProductCompany')->name('user.getAllProductCompany');
    Route::post('/insertCompanyName','Product\ProductProducerCompanyController@insertCompanyName')->name('user.insertCompanyName');
    Route::get('/updateProducerName','Product\ProductProducerCompanyController@updateProducerName')->name('user.updateProducerName');
    Route::post('/updateProducerNameStore','Product\ProductProducerCompanyController@updateProducerNameStore')->name('user.updateProducerNameStore');
    Route::post('/deleteProducerName','Product\ProductProducerCompanyController@deleteProducerName')->name('user.deleteProducerName');

    // Product Details

    Route::get('/productDetailsIndex','Product\ProductDetailsController@productDetailsIndex')->name('user.productDetailsIndex');
    Route::get('/productgetAllProductDetails','Product\ProductDetailsController@getAllProductDetails')->name('user.getAllProductDetails');
    Route::get('/getListedProduct','Product\ProductDetailsController@getListedProduct')->name('user.getListedProduct');
    Route::post('/insertProductDetails','Product\ProductDetailsController@insertProductDetails')->name('user.insertProductDetails');
    Route::get('/editProductDetails','Product\ProductDetailsController@editProductDetails')->name('user.editProductDetails');
    Route::post('/editProductDetailsUpdate','Product\ProductDetailsController@editProductDetailsUpdate')->name('user.editProductDetailsUpdate');
    Route::post('/deleteProductDetailsUpdate','Product\ProductDetailsController@deleteProductDetailsUpdate')->name('user.deleteProductDetailsUpdate');


    // Customer

    Route::get('/customerDetails','Customer\CustomerController@customerDetails')->name('user.customerDetails');
    Route::get('/getAllCustomer','Customer\CustomerController@getAllCustomer')->name('user.getAllCustomer');
    Route::post('/insertCustomerDetails','Customer\CustomerController@insertCustomerDetails')->name('user.insertCustomerDetails');
    Route::get('/editCustomerDetails','Customer\CustomerController@editCustomerDetails')->name('user.editCustomerDetails');
    Route::post('/editCustomerDetailsUpdate','Customer\CustomerController@editCustomerDetailsUpdate')->name('user.editCustomerDetailsUpdate');
    Route::post('/deleteCustomerDetailsUpdate','Customer\CustomerController@deleteCustomerDetailsUpdate')->name('user.deleteCustomerDetailsUpdate');


    // Customer Purchase

    // Route::get('/getAllProductDetails','Customer\PurchaseController@getAllProductDetails')->name('user.getAllProductDetails');
    Route::get('/getAvailableProduct','Customer\PurchaseController@getAvailableProduct')->name('user.getAvailableProduct');

    Route::get('/purchasingIndex','Customer\PurchaseController@purchasingIndex')->name('user.purchasingIndex');
    Route::post('/storePurchasingDetails','Customer\PurchaseController@storePurchasingDetails')->name('user.storePurchasingDetails');
    Route::post('/getCustomerPurchaseDetails','Customer\PurchaseController@getCustomerPurchaseDetails')->name('user.getCustomerPurchaseDetails');



    // Customer Purchase Details

    Route::get('/customerPurchaseDetails','Customer\PurchaseDetailsController@customerPurchaseDetails')->name('user.customerPurchaseDetails');
    Route::post('/customer/customerPurchaseGet','Customer\PurchaseDetailsController@customerPurchaseGet')->name('user.customerPurchaseGet');
    Route::get('/customer/customerDetailsIdWise','Customer\PurchaseDetailsController@customerDetailsIdWise')->name('user.customerDetailsIdWise');
    Route::get('/customer/purchasingRemovingDetails','Customer\PurchaseDetailsController@purchasingRemovingDetails')->name('user.purchasingRemovingDetails');
    Route::post('/customer/updatePurchasingDetails','Customer\PurchaseDetailsController@updatePurchasingDetails')->name('user.updatePurchasingDetails');


    // Report 

    Route::get('/customerdailyReport','Report\ReportController@dailyReportIndex')->name('user.dailyReportIndex');
    Route::get('/customer/dailyReport','Report\ReportController@dailyReport')->name('user.dailyReport');
    Route::get('/customermonthlyReportIndex','Report\ReportController@monthlyReportIndex')->name('user.monthlyReportIndex');
    Route::post('/customermonthly/Report','Report\ReportController@monthlyReport')->name('user.monthlyReport');


    
});





// Admin Panel

Route::get('/admin','Admin\AdminController@adminIndex');
Route::get('/admin/userList','Admin\UserController@userList')->name('admin.userList');
Route::get('/admin/getAllUser','Admin\UserController@getAllUser')->name('admin.getAllUser');
Route::post('/admin/addUser','Admin\UserController@addUser')->name('admin.addUser');
Route::get('/admin/editUser','Admin\UserController@editUser')->name('admin.editUser');
Route::post('/admin/updateUser','Admin\UserController@updateUser')->name('admin.updateUser');
Route::post('/admin/deleteUser','Admin\UserController@deleteUser')->name('admin.deleteUser');