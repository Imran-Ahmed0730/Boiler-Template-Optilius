<?php

use App\Http\Controllers\Frontend\CustomerController;
use Illuminate\Support\Facades\Route;

Route::controller(CustomerController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/login/submit', 'loginSubmit')->name('login.submit');
});

Route::middleware('customer')->prefix('customer')->name('customer.')->group(function(){
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
});
