<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SupporterOrgRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'support_type' => 'required|array',
            'assistance_time' => 'required|string',
            'attachments' => 'array',
        ];
    }
}
