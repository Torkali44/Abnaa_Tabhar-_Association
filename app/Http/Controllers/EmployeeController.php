<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $service;

    public function __construct(\App\Services\EmployeeService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Employee::latest();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $employees = $query->paginate(20)->withQueryString();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'job_type' => 'required|string',
            'phone' => 'required|string',
            'monthly_salary' => 'required|numeric',
            'vacations' => 'nullable|array',
            'absences' => 'nullable|array',
            'late_records' => 'nullable|array',
            'attachments' => 'nullable|array',
        ]);

        $this->service->createEmployee($validated);

        return redirect()->route('employees.index')
            ->with('success', 'تم إضافة الموظف بنجاح ✨');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'job_type' => 'required|string',
            'phone' => 'required|string',
            'monthly_salary' => 'required|numeric',
            'vacations' => 'nullable|array',
            'absences' => 'nullable|array',
            'late_records' => 'nullable|array',
            'attachments' => 'nullable|array',
        ]);

        $this->service->updateEmployee($employee->id, $validated);

        return redirect()->route('employees.index')
            ->with('success', 'تم تحديث بيانات الموظف بنجاح ✨');
    }

    public function destroy(Employee $employee)
    {
        $this->service->deleteEmployee($employee->id);

        return redirect()->route('employees.index')
            ->with('success', 'تم حذف الموظف بنجاح');
    }
}

