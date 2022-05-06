<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPAController;
use App\Http\Controllers\AuthenticationController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/{any}', SPAController::class)->where('any', '^(?!api).*$');
});
