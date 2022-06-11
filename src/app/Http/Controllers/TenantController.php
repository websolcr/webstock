<?php

namespace App\Http\Controllers;

use function auth;
use function request;
use App\Models\Tenant;
use function response;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class TenantController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(auth()->user()->organizations);
    }

    public function create(): Response
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
        ]);

        Tenant::create([
            'name' => request()->get('name'),
            'user_id' => auth()->id(),
        ]);

        return response()->noContent();
    }
}
