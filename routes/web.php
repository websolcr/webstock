<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPAController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');

    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
});

Route::get('/{any}', SPAController::class)->where('any', '^(?!api).*$')->middleware('auth');
