<?php

namespace App\Http\Controllers;

use Domain\Audit\Models\Audit;
use Illuminate\Http\JsonResponse;

class AuditsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Audit::with('member')
                ->latest()
                ->when(request('actions'), function ($query) {
                    $query->whereIn('action', request('actions'));
                })->when(request('members'), function ($query) {
                    $query->whereIn('member_id', request('members'));
                })->when(request('areas'), function ($query) {
                    $query->whereIn('area', request('areas'));
                })
                ->paginate(request('perPage', 10), ['*'], 'page', request('page', 1))
                ->withQueryString()
        );
    }
}
