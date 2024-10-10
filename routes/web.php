<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceAttachmentController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\Customers_Report;
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
// Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('invoices',InvoiceController::class);
Route::resource('sections',SectionController::class);
Route::resource('products',ProductController::class);
Route::get('/section/{id}', [InvoiceController::class, 'getproducts']);
Route::get('/InvoicesDetails/{id}', [InvoiceDetailController::class, 'edit']);
Route::post('delete_file', [InvoiceDetailController::class ,'destroy'])->name('delete_file');
Route::get('View_file/{invoice_number}/{file_name}', [InvoiceDetailController::class ,'open_file']);
Route::get('download/{invoice_number}/{file_name}' , [InvoiceDetailController::class ,'get_file']);
Route::resource('InvoiceAttachments', InvoiceAttachmentController::class);
Route::get('/edit_invoice/{id}', [InvoiceController::class, 'edit']);
Route::get('/Status_show/{id}', [InvoiceController::class, 'show'])->name('Status_show');
Route::post('/Status_Update/{id}', [InvoiceController::class ,'Status_Update'])->name('Status_Update');
Route::get('Invoice_Paid',[InvoiceController::class ,'Invoice_Paid']);
Route::get('Invoice_UnPaid',[InvoiceController::class ,'Invoice_UnPaid']);
Route::get('Invoice_Partial',[InvoiceController::class ,'Invoice_Partial']);
Route::resource('Archive', InvoiceAchiveController::class);
Route::get('Print_invoice/{id}',[InvoiceController::class ,'Print_invoice']);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('invoices_report',[Invoices_Report::class ,'index']);
Route::post('Search_invoices',[Invoices_Report::class ,'Search_invoices']);

Route::get('customers_report',[Customers_Report::class,'index'])->name("customers_report");
Route::post('Search_customers', [Customers_Report::class,'Search_customers']);
Route::get('MarkAsRead_all',[InvoiceController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

Route::get('/{page}',[AdminController::class,'index']);



