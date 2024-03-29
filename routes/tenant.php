<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditsController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\AuditDataController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\InvitationsController;
use App\Http\Controllers\ActiveTenantController;

Route::middleware('tenant')->prefix('/api')->group(function () {
    Route::get('/active-tenant', [ActiveTenantController::class, 'index']);

    Route::post('invitations/store', [InvitationsController::class, 'store']);

    Route::get('/tenant/show', [TenantController::class, 'show']);

    Route::get('/members', [MembersController::class, 'index']);

    //audits
    Route::get('/audits', [AuditsController::class, 'index']);

    Route::get('/audit-data', [AuditDataController::class, 'index']);

    //suppliers
    Route::get('/suppliers', [SuppliersController::class, 'index']);

    Route::post('/suppliers', [SuppliersController::class, 'store']);

    Route::put('/suppliers', [SuppliersController::class, 'update']);

    Route::delete('/suppliers/{supplier}', [SuppliersController::class, 'destroy']);
});
