<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\FundAllocation;
use App\Models\Purpose;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FundAllocationController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $allocations = FundAllocation::with(['campaign', 'purpose'])
                ->latest()
                ->get();
        } else {
            $campaignIds = Campaign::where('created_by', $user->id)->pluck('id');

            $allocations = FundAllocation::with(['campaign', 'purpose'])
                ->whereIn('campaign_id', $campaignIds)
                ->latest()
                ->get();
        }

        return view('fund-allocations.index', compact('allocations'));
    }

    public function create(): View
    {
        abort_unless(auth()->user()->isStaff(), 403);

        $campaigns = Campaign::where('created_by', auth()->id())
            ->where('status', 'approved')
            ->latest()
            ->get();

        $purposes = Purpose::where('is_active', 1)
            ->orderBy('name')
            ->get();

        return view('fund-allocations.create', compact('campaigns', 'purposes'));
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()->isStaff(), 403);

        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'purpose_id' => 'required|exists:purposes,id',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string',
        ]);

        FundAllocation::create([
            'campaign_id' => $validated['campaign_id'],
            'purpose_id' => $validated['purpose_id'],
            'amount' => $validated['amount'],
            'allocation_date' => now()->toDateString(),
            'reference_no' => 'ALC-' . now()->format('YmdHis'),
            'note' => $validated['note'] ?? null,
            'status' => 'pending',
            'submitted_by' => auth()->id(),
            'approved_by' => null,
            'approved_at' => null,
            'review_comment' => null,
        ]);

        return redirect()
            ->route('fund-allocations.index')
            ->with('success', 'Allocation submitted for admin review.');
    }

    public function show(FundAllocation $fundAllocation): View
    {
        $fundAllocation->load(['campaign', 'purpose']);

        return view('fund-allocations.show', compact('fundAllocation'));
    }

    public function edit(FundAllocation $fundAllocation): View
    {
        abort_unless(auth()->user()->isStaff(), 403);

        abort_unless(in_array($fundAllocation->status, ['pending', 'under_review']), 403);

        $campaigns = Campaign::where('created_by', auth()->id())
            ->where('status', 'approved')
            ->latest()
            ->get();

        $purposes = Purpose::where('is_active', 1)
            ->orderBy('name')
            ->get();

        return view('fund-allocations.edit', compact(
            'fundAllocation',
            'campaigns',
            'purposes'
        ));
    }

    public function update(Request $request, FundAllocation $fundAllocation): RedirectResponse
    {
        abort_unless(auth()->user()->isStaff(), 403);

        abort_unless(in_array($fundAllocation->status, ['pending', 'under_review']), 403);

        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'purpose_id' => 'required|exists:purposes,id',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string',
        ]);

        $fundAllocation->update([
            'campaign_id' => $validated['campaign_id'],
            'purpose_id' => $validated['purpose_id'],
            'amount' => $validated['amount'],
            'note' => $validated['note'] ?? null,
            'status' => 'pending',
            'approved_by' => null,
            'approved_at' => null,
            'review_comment' => null,
        ]);

        return redirect()
            ->route('fund-allocations.index')
            ->with('success', 'Allocation updated and resubmitted.');
    }

    public function destroy(FundAllocation $fundAllocation): RedirectResponse
    {
        abort_unless(auth()->user()->isStaff() || auth()->user()->isAdmin(), 403);

        $fundAllocation->delete();

        return back()->with('success', 'Allocation deleted.');
    }

    public function approve(FundAllocation $fundAllocation): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        if (in_array($fundAllocation->status, ['approved', 'rejected'])) {
            return back()->with('error', 'Allocation already finalized.');
        }

        $fundAllocation->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'review_comment' => null,
        ]);

        return back()->with('success', 'Allocation approved.');
    }

    public function reject(Request $request, FundAllocation $fundAllocation): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        if (in_array($fundAllocation->status, ['approved', 'rejected'])) {
            return back()->with('error', 'Allocation already finalized.');
        }

        $validated = $request->validate([
            'review_comment' => 'required|string',
        ]);

        $fundAllocation->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'review_comment' => $validated['review_comment'],
        ]);

        return back()->with('success', 'Allocation rejected.');
    }

    public function review(Request $request, FundAllocation $fundAllocation): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        if (in_array($fundAllocation->status, ['approved', 'rejected'])) {
            return back()->with('error', 'Allocation already finalized.');
        }

        $validated = $request->validate([
            'review_comment' => 'required|string',
        ]);

        $fundAllocation->update([
            'status' => 'under_review',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'review_comment' => $validated['review_comment'],
        ]);

        return back()->with('success', 'Allocation marked under review.');
    }
}