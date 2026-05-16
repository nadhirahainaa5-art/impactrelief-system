<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Purpose;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PublicDonationController extends Controller
{
    public function catalog(): View
    {
        $campaigns = Campaign::whereIn('status', ['active', 'approved'])
            ->latest()
            ->get();

        return view('public-donations.catalog', compact('campaigns'));
    }

    public function show(Campaign $campaign): View
    {
        abort_unless(
            in_array($campaign->status, ['active', 'approved']),
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Recalculate latest donation total for this campaign
        |--------------------------------------------------------------------------
        */
        $latestRaised = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'completed')
            ->sum('amount');

        $campaign->update([
            'amount_raised' => $latestRaised,
        ]);

        $campaign->refresh();

        /*
        |--------------------------------------------------------------------------
        | Get approved expenses only
        |--------------------------------------------------------------------------
        */
        $approvedExpenses = $campaign->expenses()
            ->where('status', 'approved')
            ->latest()
            ->get();

        $totalExpensesUsed = $approvedExpenses->sum('amount');

        $remainingBalance = max(
            $campaign->amount_raised - $totalExpensesUsed,
            0
        );

        return view('public-donations.show', compact(
            'campaign',
            'approvedExpenses',
            'totalExpensesUsed',
            'remainingBalance'
        ));
    }

    public function create(Request $request): View
    {
        $user = $request->user();

        $donor = $user && $user->isDonor()
            ? $this->resolveDonorProfile($user)
            : null;

        $campaigns = Campaign::whereIn('status', ['active', 'approved'])
            ->latest()
            ->get();

        $purposes = Purpose::latest()->get();

        return view('public-donations.create', [
            'campaigns' => $campaigns,
            'purposes' => $purposes,
            'user' => $user,
            'donor' => $donor,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'donor_name' => 'required_without:user_id|string|max:255',
            'donor_email' => 'required_without:user_id|email|max:255',
            'donor_phone' => 'nullable|string|max:30',

            'campaign_id' => 'nullable|exists:campaigns,id',
            'purpose_id' => 'nullable|exists:purposes,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|max:255',
            'payment_gateway' => 'nullable|string|max:255',
            'donation_date' => 'required|date',
            'type' => 'required|string|max:255',
            'note' => 'nullable|string',
            'proof_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:3072',
        ]);

        if ($user && $user->isDonor()) {
            $donor = $this->resolveDonorProfile($user);

            $donorName = $donor->full_name ?? $user->name;
            $donorEmail = $donor->email ?? $user->email;
            $donorPhone = $donor->phone ?? null;

            $submittedBy = $user->id;
        } else {
            $donor = Donor::firstOrCreate(
                ['email' => $validated['donor_email']],
                [
                    'user_id' => null,
                    'full_name' => $validated['donor_name'],
                    'phone' => $validated['donor_phone'] ?? null,
                    'address' => null,
                    'preferred_purpose' => null,
                    'is_active' => true,
                ]
            );

            $donorName = $validated['donor_name'];
            $donorEmail = $validated['donor_email'];
            $donorPhone = $validated['donor_phone'] ?? null;

            $submittedBy = null;
        }

        $receiptPath = null;

        if ($request->hasFile('proof_file')) {
            $receiptPath = $request->file('proof_file')
                ->store('donation-proofs', 'public');
        }

        $donation = Donation::create([
            'donor_id' => $donor->id,
            'donor_name' => $donorName,
            'donor_email' => $donorEmail,
            'donor_phone' => $donorPhone,

            
            'campaign_id' => $validated['campaign_id'] ?? null,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'payment_gateway' => $validated['payment_gateway'] ?? null,
            'transaction_reference' => 'TRX-' . strtoupper(Str::random(10)),
            'donation_date' => $validated['donation_date'],
            'type' => $validated['type'],
            'receipt_number' => 'RCPT-' . strtoupper(Str::random(8)),
            'receipt_path' => $receiptPath,
            'status' => 'completed',
            'note' => $validated['note'] ?? null,
            
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update campaign amount raised after donation is created
        |--------------------------------------------------------------------------
        */
        if ($donation->campaign_id) {
            $totalRaised = Donation::where('campaign_id', $donation->campaign_id)
                ->where('status', 'completed')
                ->sum('amount');

            Campaign::where('id', $donation->campaign_id)
                ->update([
                    'amount_raised' => $totalRaised,
                ]);
        }

        return redirect()
            ->route('public-donations.success', $donation->id)
            ->with(
                'success',
                'Donation submitted successfully.'
            );
    }

    public function success(Donation $donation): View
    {
        $donation->load(['campaign', 'donor']);

        return view('public-donations.success', compact('donation'));
    }

    private function resolveDonorProfile(?User $user): ?Donor
    {
        if (! $user || ! $user->isDonor()) {
            return null;
        }

        if ($user->relationLoaded('donor')) {
            $existingDonor = $user->getRelation('donor');

            if ($existingDonor) {
                return $existingDonor;
            }
        }

        $existingDonor = $user->donor;

        if ($existingDonor) {
            return $existingDonor;
        }

        return Donor::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
            'email' => $user->email,
            'phone' => null,
            'address' => null,
            'preferred_purpose' => null,
            'is_active' => true,
        ]);
    }
}