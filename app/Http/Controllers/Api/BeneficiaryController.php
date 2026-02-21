<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BeneficiaryRequest;
use App\Services\BeneficiaryService;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    protected $service;

    public function __construct(BeneficiaryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAllBeneficiaries());
    }

    public function store(BeneficiaryRequest $request)
    {
        $beneficiary = $this->service->createBeneficiary($request->all());
        return response()->json($beneficiary, 201);
    }

    public function show($id)
    {
        return response()->json($this->service->getBeneficiary($id));
    }

    public function update(BeneficiaryRequest $request, $id)
    {
        $beneficiary = $this->service->updateBeneficiary($id, $request->all());
        return response()->json($beneficiary);
    }

    public function destroy($id)
    {
        $this->service->deleteBeneficiary($id);
        return response()->json(null, 204);
    }
}
