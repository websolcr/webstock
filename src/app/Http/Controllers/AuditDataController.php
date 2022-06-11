<?php

namespace App\Http\Controllers;

use App\Data\AuditData;
use Illuminate\Http\JsonResponse;

class AuditDataController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(AuditData::FILTERS[request('filter')]);
    }
}
