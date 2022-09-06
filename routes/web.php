<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShipxController;

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

Route::get('/', [HomeController::class, 'showProducts'])
    ->name('home');
Route::get('/product/{product}', [HomeController::class, 'productDetail'])
    ->name('detail');
Route::get('/cart', [CartController::class, 'showCart'])
    ->name('cart');
Route::post('add-product/{product}', [CartController::class, 'addProduct'])
    ->name('cart.add');
Route::post('remove-product/{product}', [CartController::class, 'removeProduct'])
    ->name('cart.remove');
Route::post('/payment/create', [PaymentController::class, 'showSummary'])
    ->name('payment.create');
Route::post('/payment/process', [PaymentController::class, 'paymentProcess'])
    ->name('payment.process');
Route::post('/payment_urlc', [PaymentController::class, 'urlcReceiver']); 
Route::post('/payment/done/{order}', [PaymentController::class, 'paymentSuccess']);
Route::view('/payment/canceled', 'payment/canceled')
    ->name('payment.canceled');

Route::view('/shipx/login','/shipx/login')
    ->name('shipx.login.view');
Route::post('/shipx/logined', [ShipxController::class, 'login'])
    ->name('shipx.login');
Route::get('shipx/logout', [ShipxController::class, 'logout'])
    ->name('shipx.logout');
Route::get('/shipx',[ShipxController::class, 'showOrders'])
    ->name('shipx.home')
    ->middleware('isAdmin');
Route::get('/shipx/{order}', [ShipxController::class, 'orderDetail'])
    ->name('shpix.detail')
    ->middleware('isAdmin');
Route::post('/shipx/update/{order}', [ShipxController::class, 'changeStatus'])
    ->name('shipx.update')
    ->middleware('isAdmin');