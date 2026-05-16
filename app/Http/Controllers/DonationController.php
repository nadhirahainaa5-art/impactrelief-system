<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $donations = Donation::with(['campaign', 'donor'])
                ->latest()
                ->get();

        } elseif ($user->isDonor()) {
            $donor = Donor::where('user_id', $user->id)->first();

            $donations = Donation::with(['campaign', 'donor'])
                ->when($donor, function ($query) use ($donor) {
                    return $query->where('donor_id', $donor->id);
                })
                ->latest()
                ->get();

        } else {
            $donations = Donation::with(['campaign', 'donor'])
                ->latest()
                ->get();
        }

        $totalAmount = $donations->sum('amount');
        $successfulDonations = $donations->where('status', 'completed')->count();

        $methodsUsed = $donations
            ->pluck('payment_method')
            ->filter()
            ->unique()
            ->count();

        return view('donations.index', compact(
            'donations',
            'totalAmount',
            'successfulDonations',
            'methodsUsed'
        ));
    }

    public function publicCreate(Request $request): View
    {
        $campaigns = Campaign::where('status', 'approved')
            ->latest()
            ->get();

        $selectedCampaign = $request->campaign;

        return view('donations.create', compact(
            'campaigns',
            'selectedCampaign'
        ));
    }

    public function publicStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'bank_name' => 'nullable|string|max:255',
        ]);

        $campaign = Campaign::findOrFail($validated['campaign_id']);

        $donor = Donor::where('user_id', auth()->id())->firstOrFail();

        $receiptNumber = 'RCP-' . strtoupper(substr($campaign->title, 0, 3)) . '-' . now()->format('YmdHis');

        $donation = Donation::create([
            'campaign_id' => $campaign->id,
            'donor_id' => $donor->id,
            'amount' => $validated['amount'],
            'donation_date' => now()->toDateString(),
            'payment_method' => $validated['payment_method'],
            'payment_gateway' => $validated['bank_name'] ?? null,
            'type' => 'one-time',
            'receipt_number' => $receiptNumber,
            'receipt_path' => null,
            'status' => 'completed',
            'submitted_by' => auth()->id(),
            'approved_by' => 1,
            'approved_at' => now(),
        ]);

        $campaign->increment('amount_raised', $validated['amount']);

        return redirect()
            ->route('donations.receipt', $donation)
            ->with('success', 'Donation successful. Receipt generated.');
    }

    public function receipt(Donation $donation): View
    {
        $user = auth()->user();

        $donor = Donor::where('user_id', $user->id)->first();

        abort_unless(
            $user->isAdmin()
            || $user->isStaff()
            || ($donor && $donation->donor_id == $donor->id),
            403
        );

        $donation->load(['campaign', 'donor']);

        return view('donations.receipt', compact('donation'));
    }

    public function certificate(Donation $donation)
    {
    return view('donations.certificate', compact('donation'));
    }

    public function create(): View
    {
        return view('donations.create', [
            'campaigns' => Campaign::where('status', 'approved')->latest()->get(),
            'selectedCampaign' => null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->publicStore($request);
    }

    public function show(Donation $donation): View
    {
        $user = auth()->user();

        $donor = Donor::where('user_id', $user->id)->first();

        abort_unless(
            $user->isAdmin()
            || $user->isStaff()
            || ($donor && $donation->donor_id == $donor->id),
            403
        );

        $donation->load(['campaign', 'donor']);

        return view('donations.show', compact('donation'));
    }

    public function edit(Donation $donation): View
    {
        abort(403);
    }

    public function update(Request $request, Donation $donation): RedirectResponse
    {
        abort(403);
    }

    public function destroy(Donation $donation): RedirectResponse
    {
        abort(403);
    }
}