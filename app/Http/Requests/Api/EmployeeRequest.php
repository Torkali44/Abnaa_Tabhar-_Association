<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'job_type' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'monthly_salary' => 'required|numeric',
            'vacations' => 'array',
            'absences' => 'array',
            'late_records' => 'array',
            'attachments' => 'array',
        ];
    }
}
