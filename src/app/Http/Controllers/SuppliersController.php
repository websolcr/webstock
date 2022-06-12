<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Domain\Supplier\Models\Supplier;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Domain\Supplier\Actions\SaveSupplierAction;
use Domain\Supplier\Actions\MultipleSuppliersUpdateAction;

class SuppliersController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Supplier::query()->latest()->get(),
        );
    }

    public function store(SupplierRequest $request, SaveSupplierAction $saveSupplierAction): Response
    {
        DB::transaction(fn () => $saveSupplierAction->execute($request->data()));

        return response()->noContent();
    }

    public function update(UpdateSupplierRequest $request, MultipleSuppliersUpdateAction $multipleSuppliersUpdateAction): Response
    {
        DB::transaction(fn () => $multipleSuppliersUpdateAction->execute($request->modifiedSuppliers()));

        return response()->noContent();
    }

    public function destroy(Supplier $supplier): Response
    {
        $supplier->delete();

        return response()->noContent();
    }
}
