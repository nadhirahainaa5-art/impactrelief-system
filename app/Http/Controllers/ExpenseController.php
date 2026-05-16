<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Expense;
use App\Models\FundAllocation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $expenses = Expense::with(['campaign', 'fundAllocation'])
                ->latest()
                ->get();

            $summaryExpenses = Expense::query();
        } else {
            $campaignIds = Campaign::where('created_by', $user->id)->pluck('id');

            $expenses = Expense::with(['campaign', 'fundAllocation'])
                ->whereIn('campaign_id', $campaignIds)
                ->latest()
                ->get();

            $summaryExpenses = Expense::whereIn('campaign_id', $campaignIds);
        }

        $submittedClaims = (clone $summaryExpenses)->count();

        $requestedSpending = (clone $summaryExpenses)
            ->whereIn('status', ['pending', 'under_review'])
            ->sum('amount');

        $approvedBudgetUsage = (clone $summaryExpenses)
            ->where('status', 'approved')
            ->sum('amount');

        $claimsNeedingAction = (clone $summaryExpenses)
            ->whereIn('status', ['pending', 'under_review'])
            ->count();

        return view('expenses.index', compact(
            'expenses',
            'submittedClaims',
            'requestedSpending',
            'approvedBudgetUsage',
            'claimsNeedingAction'
        ));
    }

    public function create(): View
    {
        abort_unless(auth()->user()->isStaff(), 403);

        $approvedAllocations = FundAllocation::with(['campaign', 'purpose'])
            ->where('status', 'approved')
            ->whereHas('campaign', function ($query) {
                $query->where('created_by', auth()->id());
            })
            ->latest()
            ->get();

        return view('expenses.create', compact('approvedAllocations'));
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()->isStaff(), 403);

        $validated = $request->validate([
            'fund_allocation_id' => 'required|exists:fund_allocations,id',
            'amount' => 'required|numeric|min:1',
            'expense_type' => 'required|string|max:255',
            'expense_date' => 'required|date',
            'vendor' => 'nullable|string|max:255',
            'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'description' => 'nullable|string',
        ]);

        $allocation = FundAllocation::with('campaign')
            ->where('id', $validated['fund_allocation_id'])
            ->where('status', 'approved')
            ->firstOrFail();

        abort_unless(
            $allocation->campaign &&
            $allocation->campaign->created_by === auth()->id(),
            403
        );

        $usedAmount = Expense::where('fund_allocation_id', $allocation->id)
            ->where('status', 'approved')
            ->sum('amount');

        $remainingBalance = $allocation->amount - $usedAmount;

        if ($validated['amount'] > $remainingBalance) {
            return back()
                ->withInput()
                ->withErrors([
                    'amount' => 'Expense claim exceeds remaining approved budget balance. Remaining balance: RM'
                        . number_format($remainingBalance, 2),
                ]);
        }

        $receiptPath = null;

        if ($request->hasFile('receipt')) {
            $receiptPath = $request->file('receipt')->store('receipts', 'public');
        }

        Expense::create([
            'fund_allocation_id' => $allocation->id,
            'campaign_id' => $allocation->campaign_id,
            'amount' => $validated['amount'],
            'expense_type' => $validated['expense_type'],
            'expense_date' => $validated['expense_date'],
            'vendor' => $validated['vendor'] ?? null,
            'receipt' => $receiptPath,
            'description' => $validated['description'] ?? null,
            'status' => 'pending',
            'review_comment' => null,
            'submitted_by' => auth()->id(),
        ]);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense claim submitted for admin review.');
    }

    public function show(Expense $expense): View
    {
        $expense->load(['campaign', 'fundAllocation']);

        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense): View
    {
        abort_unless(auth()->user()->isStaff(), 403);

        abort_unless(in_array($expense->status, ['pending', 'under_review']), 403);

        $approvedAllocations = FundAllocation::with(['campaign', 'purpose'])
            ->where('status', 'approved')
            ->whereHas('campaign', function ($query) {
                $query->where('created_by', auth()->id());
            })
            ->latest()
            ->get();

        return view('expenses.edit', compact('expense', 'approvedAllocations'));
    }

    public function update(Request $request, Expense $expense): RedirectResponse
    {
        abort_unless(auth()->user()->isStaff(), 403);

        abort_unless(in_array($expense->status, ['pending', 'under_review']), 403);

        $validated = $request->validate([
            'fund_allocation_id' => 'required|exists:fund_allocations,id',
            'amount' => 'required|numeric|min:1',
            'expense_type' => 'required|string|max:255',
            'expense_date' => 'required|date',
            'vendor' => 'nullable|string|max:255',
            'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'description' => 'nullable|string',
        ]);

        $allocation = FundAllocation::with('campaign')
            ->where('id', $validated['fund_allocation_id'])
            ->where('status', 'approved')
            ->firstOrFail();

        abort_unless(
            $allocation->campaign &&
            $allocation->campaign->created_by === auth()->id(),
            403
        );

        $usedAmount = Expense::where('fund_allocation_id', $allocation->id)
            ->where('status', 'approved')
            ->where('id', '!=', $expense->id)
            ->sum('amount');

        $remainingBalance = $allocation->amount - $usedAmount;

        if ($validated['amount'] > $remainingBalance) {
            return back()
                ->withInput()
                ->withErrors([
                    'amount' => 'Expense claim exceeds remaining approved budget balance. Remaining balance: RM'
                        . number_format($remainingBalance, 2),
                ]);
        }

        $receiptPath = $expense->receipt;

        if ($request->hasFile('receipt')) {
            if ($expense->receipt) {
                Storage::disk('public')->delete($expense->receipt);
            }

            $receiptPath = $request->file('receipt')->store('receipts', 'public');
        }

        $expense->update([
            'fund_allocation_id' => $allocation->id,
            'campaign_id' => $allocation->campaign_id,
            'amount' => $validated['amount'],
            'expense_type' => $validated['expense_type'],
            'expense_date' => $validated['expense_date'],
            'vendor' => $validated['vendor'] ?? null,
            'receipt' => $receiptPath,
            'description' => $validated['description'] ?? null,
            'status' => 'pending',
            'review_comment' => null,
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense claim updated and resubmitted.');
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        abort_unless(auth()->user()->isStaff(), 403);

        abort_unless(in_array($expense->status, ['pending', 'under_review']), 403);

        if ($expense->receipt) {
            Storage::disk('public')->delete($expense->receipt);
        }

        $expense->delete();

        return back()->with('success', 'Expense claim deleted.');
    }

    public function approve(Expense $expense): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        abort_if(
            in_array($expense->status, ['approved', 'rejected']),
            403,
            'This expense claim is already finalized.'
        );

        $allocation = FundAllocation::find($expense->fund_allocation_id);

        if (! $allocation || $allocation->status !== 'approved') {
            return back()->withErrors([
                'expense' => 'This claim is not linked to an approved budget allocation.',
            ]);
        }

        $usedAmount = Expense::where('fund_allocation_id', $allocation->id)
            ->where('status', 'approved')
            ->where('id', '!=', $expense->id)
            ->sum('amount');

        $remainingBalance = $allocation->amount - $usedAmount;

        if ($expense->amount > $remainingBalance) {
            return back()->withErrors([
                'expense' => 'Cannot approve this claim because it exceeds the remaining approved budget balance. Remaining balance: RM'
                    . number_format($remainingBalance, 2),
            ]);
        }

        $expense->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'review_comment' => null,
        ]);

        $campaign = Campaign::find($expense->campaign_id);

        if ($campaign) {
            $campaign->update([
                'amount_used' => Expense::where('campaign_id', $campaign->id)
                    ->where('status', 'approved')
                    ->sum('amount'),
            ]);
        }

        return back()->with('success', 'Expense claim approved.');
    }

    public function reject(Request $request, Expense $expense): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $validated = $request->validate([
            'review_comment' => 'required|string',
        ]);

        $expense->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'review_comment' => $validated['review_comment'],
        ]);

        return back()->with('success', 'Expense claim rejected.');
    }

    public function review(Request $request, Expense $expense): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        $validated = $request->validate([
            'review_comment' => 'required|string',
        ]);

        $expense->update([
            'status' => 'under_review',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'review_comment' => $validated['review_comment'],
        ]);

        return back()->with('success', 'Expense claim marked under review.');
    }
}