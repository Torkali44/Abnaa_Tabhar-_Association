<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SupporterOrgRequest;
use App\Services\SupporterService;
use Illuminate\Http\Request;

class SupporterOrgController extends Controller
{
    protected $service;

    public function __construct(SupporterService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAllOrgs());
    }

    public function store(SupporterOrgRequest $request)
    {
        return response()->json($this->service->createOrg($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json($this->service->getOrg($id));
    }

    public function update(SupporterOrgRequest $request, $id)
    {
        return response()->json($this->service->updateOrg($id, $request->all()));
    }

    public function destroy($id)
    {
        $this->service->deleteOrg($id);
        return response()->json(null, 204);
    }
}

