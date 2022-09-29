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
    return view('auth.login');
});

Auth::routes();
//Auth::routes(['register' => false]);


// @@@@@@@@@@@@@@@ //
Route::get('/sections','SectionsController@index');
Route::post('section_store','SectionsController@store');
Route::post('section_update/{id}','SectionsController@update');
Route::get('section_delete/{id}','SectionsController@destroy');

// products ///
Route::get('/products','ProductsController@index');
Route::post('/products_store','ProductsController@store');
Route::get('/deleting_product/{id}','ProductsController@destroy');
Route::post('/editing_product/{id}','ProductsController@update');

// invoices ///
Route::get('/invoices/{id?}','InvoicesController@index');
Route::get('/delete_invoices/{id}','InvoicesController@destroy');
Route::get('/Adding_invoices','InvoicesController@create');
Route::post('/invoices_store','InvoicesController@store');
Route::get('/section/{id}','InvoicesController@getproducts');
Route::get('/editing_invoice/{id}','InvoicesController@edit');
Route::post('/invoices_update/{id}','InvoicesController@update');
Route::get('/Invoice_moveToTrash/{id}','InvoicesController@ToTrash');
Route::get('/Status_show/{id}','InvoicesController@Status_show');
Route::post('/INstatus_update/{id}','InvoicesController@status_update');
Route::get('/invoices_trash','InvoicesController@invoices_trash')->name('invoicesTrash');
Route::get('/restore_invoice/{id}','InvoicesController@restore_invoice');
Route::get('/PrintInvoice/{id}','InvoicesController@PrintInvoice');
// Excel Exort
Route::get('exportInvoices', 'InvoicesController@exportExcel');

Route::get('/invoicesDetails/{id}','InvoicesDetailsController@index');
Route::post('/delete_attachment_file/{id}','InvoicesAttechmentsController@destroy');
Route::get('/download/{folder_name}/{file_name}','InvoicesAttechmentsController@show');
Route::post('/Additional_InvoiceAttachments','InvoicesAttechmentsController@store');
// Route::post('/editing_product/{id}','ProductsController@update');
// @@@@@@@@@@@@@@@ //
Route::get('/home', 'HomeController@index')->name('home');
// @@@@@@@@@@@@

//middleware  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    //Route::resource('products', ProductController::class);
});

// invoicesReport
Route::get('/invoicesReport','InvoicesReport@index');
Route::post('/Search_invoices','InvoicesReport@Search_invoices');
//invoicesCustomers 
Route::get('/invoicesCustomers','CustomersReport@index');
Route::post('/SearchCustomers','CustomersReport@SearchCustomers');


Route::get('/MarkAsRead_All','InvoicesController@MarkAsRead_All');

// Footer
Route::get('/{page}', 'AdminController@index');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();



