<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Domain\Audit\Actions\ListAuditAction;

class AuditsController extends Controller
{
    public function index(ListAuditAction $listAuditAction): JsonResponse
    {
        $filters = collect(request()->toArray(), [])->reject(fn($value, $key) => in_array($key, ['perPage', 'page']));

        return response()->json(
            $listAuditAction->execute(
                filters: $filters,
                perPage: request('perPage', 10),
                page: request('page', 1),
            )
        );
    }
}
