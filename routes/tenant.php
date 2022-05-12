<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationSendController;
use App\Http\Controllers\Api\ActiveTenantController;

Route::middleware('tenant')->prefix('/api')->group(function () {
    Route::get('/active-tenant', [ActiveTenantController::class, 'index']);

    Route::post('invitation-send', InvitationSendController::class);
});
