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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('medicines', 'MedicineController');
Route::resource('categories', 'CategoryController');

Route::get('coba1', 'MedicineController@coba1');
Route::get('coba2', 'MedicineController@coba2');
Route::get('report/highestprice','MedicineController@highestprice');
Route::post('/medicines/showInfo','MedicineController@showInfo')->name('medicines.showInfo');

Route::get('coba2_category', 'CategoryController@coba2');
Route::get('report/listmedicine/{id}','CategoryController@showlist');

Route::resource('transactions', 'TransactionController');
Route::post('transactions/showDataAjax', 'TransactionController@showAjax')
    ->name('transactions.showAjax');
Route::get('transactions/showDataAjax2/{id}', 'TransactionController@showAjax2')
    ->name('transactions.showAjax2');

Route::resource('suppliers', 'SupplierController');