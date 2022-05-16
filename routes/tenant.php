<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditsController;
use App\Http\Controllers\ActiveTenantController;
use App\Http\Controllers\InvitationSendController;

Route::middleware('tenant')->prefix('/api')->group(function () {
    Route::get('active-tenant', [ActiveTenantController::class, 'index']);

    Route::post('invitation-send', InvitationSendController::class);

    Route::get('audits', [AuditsController::class, 'index']);
});
