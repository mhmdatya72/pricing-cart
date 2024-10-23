<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route to display products
Route::get('/', [InvoiceController::class, 'showProducts'])->name('show.products');

// Route to calculate and generate invoice
Route::post('/invoice', [InvoiceController::class, 'generateInvoice'])->name('generate.invoice');