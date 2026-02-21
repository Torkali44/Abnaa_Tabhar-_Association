<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SupporterIndividualRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:300',
            'phone' => 'required|string|max:20',
            'national_id' => 'required|string|max:20',
            'donation_type' => 'required|in:مادي,عيني',
            'donation_amount' => 'required|string',
            'donation_time' => 'required|string',
            'donation_date' => 'required|date',
            'contact_method' => 'required|string',
            'payment_method' => 'required|string',
            'donation_goal' => 'required|array',
            'attachments' => 'array',
        ];
    }
}
