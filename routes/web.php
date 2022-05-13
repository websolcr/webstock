<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPAController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\InvitationAcceptController;

Route::get('/invitation-accept', InvitationAcceptController::class)->name('invitation.accept');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/{any}', SPAController::class)->where('any', '^(?!api).*$');
});
