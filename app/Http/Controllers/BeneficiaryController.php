<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    protected $service;
    
    public function __construct(\App\Services\BeneficiaryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Beneficiary::latest();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('family_status')) {
            $query->whereJsonContains('family_status', $request->family_status);
        }

        $beneficiaries = $query->paginate(20)->withQueryString();

        return view('beneficiaries.index', compact('beneficiaries'));
    }

    public function create()
    {
        return view('beneficiaries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|unique:beneficiaries,national_id|max:14',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string',
            'birth_date' => 'nullable|date',
            'social_status' => 'required|string',
            'spouse_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'monthly_income' => 'nullable|numeric',
            'has_children' => 'nullable|boolean',
            'children' => 'nullable|array',
            'family_status' => 'nullable|array',
            'needs' => 'nullable|array',
            'supporting_entity' => 'nullable|array',
            'attachments' => 'nullable|array',
            'need_level' => 'nullable|string',
        ], [
            'national_id.unique' => 'الرقم القومي مسجل بالفعل لحالة أخرى',
        ]);

        if (!$request->has('has_children')) {
            $validated['has_children'] = false;
        }

        $this->service->createBeneficiary($validated);

        return redirect()->route('beneficiaries.index')
            ->with('success', 'تم تسجيل الحالة بنجاح وإصدار الملف الرقمي ✨');
    }

    public function edit(Beneficiary $beneficiary)
    {
        return view('beneficiaries.edit', compact('beneficiary'));
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|max:14|unique:beneficiaries,national_id,' . $beneficiary->id,
            'phone' => 'required|string|unique:beneficiaries,phone,' . $beneficiary->id,
            'gender' => 'required|in:ذكر,أنثى',
            'birth_date' => 'nullable|date',
            'social_status' => 'required|string',
            'spouse_name' => 'nullable|string',
            'address' => 'nullable|string',
            'monthly_income' => 'nullable|numeric',
            'has_children' => 'boolean',
            'children' => 'nullable|array',
            'family_status' => 'nullable|array',
            'needs' => 'nullable|array',
            'supporting_entity' => 'nullable|array',
            'attachments' => 'nullable|array',
            'need_level' => 'nullable|string',
        ]);

        $this->service->updateBeneficiary($beneficiary->id, $validated);

        return redirect()->route('beneficiaries.index')
            ->with('success', 'تم تحديث بيانات المستفيد بنجاح');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        $this->service->deleteBeneficiary($beneficiary->id);

        return redirect()->route('beneficiaries.index')
            ->with('success', 'تم حذف المستفيد بنجاح');
    }

    public function show(Beneficiary $beneficiary)
    {
        return view('beneficiaries.show', compact('beneficiary'));
    }
}

