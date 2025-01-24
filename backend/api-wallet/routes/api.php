<?php

use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register-client', [WalletController::class, 'registerClient']);
Route::post('/recharge-wallet', [WalletController::class, 'rechargeWallet']);
Route::post('/pay', [WalletController::class, 'pay']);
Route::post('/confirm-payment', [WalletController::class, 'confirmPayment']);
Route::post('/check-balance', [WalletController::class, 'checkBalance']);
