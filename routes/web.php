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
Route::group(['middleware'=>['testing']],function() {
    Route::group(['namespace'=>'Web'],function() {
        Route::group(['prefix'=>'user'],function() {
            Route::get('/','UserController@index');
        });
        Route::group(['prefix'=>'customer'],function() {
            Route::get('/','CustomerController@index');
        });
        Route::group(['prefix'=>'product'],function() {
            Route::get('/','ProductController@index');
        });
        Route::group(['prefix'=>'category'],function() {
            Route::get('/','CategoryController@index');
        });
        Route::group(['prefix'=>'sale_invoice'],function() {
            Route::get('/','SaleInvoiceController@index');
            Route::get('get_product_name','SaleInvoiceController@get_product_name');
            Route::post('create','SaleInvoiceController@sale_create');
            Route::get('sale_record','SaleInvoiceController@sale_record');
            Route::get('sale_record_filter','SaleInvoiceController@sale_record_filter');
            Route::get('/detail','SaleInvoiceController@detail');
        });
        Route::group(['prefix'=>'daily_usage'],function() {
            Route::get('/','DailyUsageController@index');
            Route::get('/create','DailyUsageController@create');
            Route::post('/store','DailyUsageController@store');
            Route::get('/filter_usage','DailyUsageController@filter_usage');
            Route::get('/filter_monthly','DailyUsageController@filterMonthly');
        });
    });
});

Route::group(['namespace'=>'Web'],function() {
//    Route::get('/','StaffController@index');
    Route::get('/','LoginController@index');
    Route::get('login','LoginController@index');
    Route::post('login','LoginController@login');
    Route::match(['get','post'],'logout',"LoginController@logout");
});

