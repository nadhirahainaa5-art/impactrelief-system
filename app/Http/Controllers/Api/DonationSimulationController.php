<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Purpose;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationSimulationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'purpose_id' => 'nullable|exists:purposes,id',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'payment_gateway' => 'required|string|in:ToyyibPay Simulation,Stripe Simulation,Manual Online Transfer',
        ]);

        $donor = Donor::firstOrCreate(
            ['email' => $validated['email']],
            [
                'full_name' => $validated['full_name'],
                'preferred_purpose' => optional(Purpose::find($validated['purpose_id'] ?? null))->name,
                'is_active' => true,
            ]
        );

        $donation = Donation::create([
            'donor_id' => $donor->id,
            'purpose_id' => $validated['purpose_id'] ?? null,
            'campaign_id' => $validated['campaign_id'] ?? null,
            'amount' => $validated['amount'],
            'payment_method' => 'Online Payment',
            'payment_gateway' => $validated['payment_gateway'],
            'transaction_reference' => 'API-TXN-' . strtoupper(Str::random(8)),
            'is_online' => true,
            'donation_date' => now()->toDateString(),
            'type' => 'one-time',
            'receipt_number' => 'API-REC-' . now()->format('YmdHis'),
            'status' => 'approved',
            'note' => 'Created from API donation simulation endpoint',
            'submitted_by' => 1,
            'approved_by' => 1,
            'approved_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Online donation simulation recorded successfully.',
            'data' => [
                'id' => $donation->id,
                'receipt_number' => $donation->receipt_number,
                'transaction_reference' => $donation->transaction_reference,
                'amount' => $donation->amount,
                'status' => $donation->status,
            ],
        ], 201);
    }
}
