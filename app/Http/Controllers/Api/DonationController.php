<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        return Donation::with('beneficiary')->latest('date')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supporter_id' => 'required|string',
            'supporter_type' => 'required|string',
            'beneficiary_id' => 'nullable|string|exists:beneficiaries,id',
            'amount' => 'required|numeric|min:1',
            'category' => 'required|string',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $donation = Donation::create($validated);

        if ($donation->beneficiary_id) {
            $beneficiary = Beneficiary::find($donation->beneficiary_id);
            $history = $beneficiary->assistance_history ?? [];
            $history[] = [
                'date' => $donation->date,
                'type' => $donation->category,
                'amount' => $donation->amount . ' ج.م',
                'donation_id' => $donation->id
            ];
            $beneficiary->update(['assistance_history' => $history]);
        }

        return response()->json($donation, 201);
    }
}

