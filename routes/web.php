<?php

use App\Http\Controllers\Auth\ControllerRegistrasi;
use App\Http\Controllers\Auth\ControllerLogin;
use App\Http\Controllers\User\ControllerDashboard;
use App\Http\Controllers\User\ControllerTransaction;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public');
});

Route::get('/register', [ControllerRegistrasi::class, 'index'])->name('register.index');
Route::post('/register', [ControllerRegistrasi::class, 'store'])->name('register.store');
Route::get('/login', [ControllerLogin::class, 'index'])->name('login');
Route::post('/login', [ControllerLogin::class, 'store'])->name('login.store');


Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [ControllerLogin::class, 'logout'])->name('logout');
    Route::get('/dashboard', [ControllerDashboard::class, 'index'])->name('dashboard.index');
    Route::put('/account/update-saldo', [ControllerDashboard::class, 'updateSaldo'])->name('account.updateSaldo');
    Route::get('/transaction/create', [ControllerTransaction::class, 'create'])->name('transaction.create');
    Route::post('/transaction/store', [ControllerTransaction::class, 'store'])->name('transaction.store');
    Route::get('/transaction/show', [ControllerTransaction::class, 'show'])->name('transaction.show');
    Route::delete('/transaction/{id}', [ControllerTransaction::class, 'destroy'])->name('transaction.destroy');
});
