<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SupporterIndividualRequest;
use App\Services\SupporterService;
use Illuminate\Http\Request;

class SupporterIndividualController extends Controller
{
    protected $service;

    public function __construct(SupporterService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAllIndividuals());
    }

    public function store(SupporterIndividualRequest $request)
    {
        return response()->json($this->service->createIndividual($request->all()), 201);
    }

    public function show($id)
    {
        return response()->json($this->service->getIndividual($id));
    }

    public function update(SupporterIndividualRequest $request, $id)
    {
        return response()->json($this->service->updateIndividual($id, $request->all()));
    }

    public function destroy($id)
    {
        $this->service->deleteIndividual($id);
        return response()->json(null, 204);
    }
}

