<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $service;

    public function __construct(EmployeeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAllEmployees());
    }

    public function store(EmployeeRequest $request)
    {
        $employee = $this->service->createEmployee($request->all());
        return response()->json($employee, 201);
    }

    public function show($id)
    {
        return response()->json($this->service->getEmployee($id));
    }

    public function update(Request $request, $id)
    {
        $employee = $this->service->updateEmployee($id, $request->all());
        return response()->json($employee);
    }

    public function destroy($id)
    {
        $this->service->deleteEmployee($id);
        return response()->json(null, 204);
    }
}

