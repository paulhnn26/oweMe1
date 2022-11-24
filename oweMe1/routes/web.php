<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Controller;
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
})->middleware(['auth', 'verified'])->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/index', [BillController::class, 'index']);



Route::get('paymentlist',[PaymentController::class, 'index'])->middleware(['auth', 'verified'])->name('showpaymentlist');
Route::get('addpayment',[PaymentController::class, 'addPayment'])->middleware(['auth', 'verified']);
Route::post('savepayment',[PaymentController::class, 'savePayment'])->middleware(['auth', 'verified']);
Route::get('editpayment/{id}',[PaymentController::class, 'editPayment'])->middleware(['auth', 'verified']);
Route::post('updatepayment',[PaymentController::class, 'updatePayment'])->middleware(['auth', 'verified']);
Route::get('deletepayment/{id}',[PaymentController::class, 'deletePayment'])->middleware(['auth', 'verified']);
Route::get('/search',[PaymentController::class, 'search'])->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('bills', BillController::class);

    

    
    
    
    }); 
    