<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $donation = Donation::create([
            'beneficiary_id' => $validated['beneficiary_id'],
            'amount' => $validated['amount'],
            'category' => $validated['category'],
            'date' => $validated['date'],
            'notes' => $validated['notes'],
            'supporter_type' => 'نقدية الجمعية',
            'supporter_id' => auth()->id(),
        ]);

        return back()->with('success', 'تم تسجيل صرف المساعدة بنجاح ✨');
    }
}
