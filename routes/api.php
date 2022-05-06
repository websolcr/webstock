<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticatedUserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::get('myself', [AuthenticatedUserController::class, 'show']);
    Route::get('tenant', [AuthenticatedUserController::class, 'activeTenant']);
    Route::post('create-organization', [AuthenticatedUserController::class, 'createOrganization']);
});
