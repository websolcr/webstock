<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\JsonResponse;

class AuditFilterController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Audit::query()
            ->when(request('actions'), function ($query) {
                $query->whereIn('action', request('actions'));
            })->when(request('members'), function ($query) {
                $query->whereIn('member_id', request('members'));
            })->when(request('areas'), function ($query) {
                $query->whereIn('area', request('areas'));
            })
            ->get()
        );
    }
}
