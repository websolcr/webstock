<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\AuditDataController;
use App\Http\Controllers\AuditFilterController;
use App\Http\Controllers\InvitationsController;
use App\Http\Controllers\ActiveTenantController;

Route::middleware('tenant')->prefix('/api')->group(function () {
    Route::get('active-tenant', [ActiveTenantController::class, 'index']);

    Route::post('invitations/store', [InvitationsController::class, 'store']);

    Route::get('audits', [AuditsController::class, 'index']);

    Route::get('members', [MembersController::class, 'index']);

    Route::get('audit-data', [AuditDataController::class, 'index']);

    Route::get('audits/filter', [AuditFilterController::class, 'index']);
});
