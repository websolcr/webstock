<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\JsonResponse;

class AuditsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Audit::all());
    }
}
