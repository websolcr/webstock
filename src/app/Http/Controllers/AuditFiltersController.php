<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Domain\Audit\Actions\ListAuditFiltersActions;

class AuditFiltersController extends Controller
{
    public function index(ListAuditFiltersActions $listAuditFiltersActions): JsonResponse
    {
        return response()->json($listAuditFiltersActions->execute());
    }
}
