<?php

use App\Http\Controllers\GetBalanceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pages.dashboard.index');
});

Route::get('/get-balance', [GetBalanceController::class, 'getBalance'])->name('get.balance');
Route::get('/checkout', [GetBalanceController::class, 'checkOut'])->name('checkout');
Route::post('/webhook', [GetBalanceController::class, 'handleCallback']);
