<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantInitializeController;
use App\Http\Controllers\AuthenticatedUserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::get('/myself', [AuthenticatedUserController::class, 'show']);

    Route::post('/tenant/create', [TenantController::class, 'create']);
    Route::get('/tenant/index', [TenantController::class, 'index']);

    Route::post('/tenant/{tenant}/initialize', TenantInitializeController::class);
});
