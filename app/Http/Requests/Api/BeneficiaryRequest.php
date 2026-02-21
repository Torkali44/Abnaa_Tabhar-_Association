<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BeneficiaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('beneficiary');

        return [
            'name' => 'required|string|max:100',
            'gender' => 'required|in:ذكر,أنثى',
            'birth_date' => 'required|date',
            'social_status' => 'required|string',
            'address' => 'required|string|max:300',
            'national_id' => [
                'required',
                'string',
                'max:20',
                Rule::unique('beneficiaries', 'national_id')->ignore($id),
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('beneficiaries', 'phone')->ignore($id),
            ],
            'monthly_income' => 'required|numeric|min:0',
            'has_children' => 'required|boolean',
            'children' => 'nullable|array',
            'family_status' => 'nullable|array',
            'needs' => 'nullable|array',
            'supporting_entity' => 'nullable|array',
            'attachments' => 'nullable|array',
            'assistance_history' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'national_id.unique' => 'رقم الهوية هذا مسجل بالفعل لمستفيد آخر.',
            'phone.unique' => 'رقم الهاتف هذا مسجل بالفعل لمستفيد آخر.',
            'name.required' => 'الاسم مطلوب.',
            'social_status.required' => 'الحالة الاجتماعية مطلوبة.',
            'monthly_income.required' => 'الدخل الشهري مطلوب.',
        ];
    }
}
