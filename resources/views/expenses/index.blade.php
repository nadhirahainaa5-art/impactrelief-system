@extends('layouts.app')

@section('title', 'Expense Claims Centre')
@section('page_title', 'Expense Claims Centre')

@section('content')

@php
    $totalClaimed = $requestedSpending ?? $expenses
        ->whereIn('status', ['pending', 'under_review'])
        ->sum('amount');

    $approvedClaimed = $approvedBudgetUsage ?? $expenses
        ->where('status', 'approved')
        ->sum('amount');

    $pendingClaims = $expenses->where('status', 'pending')->count();
    $revisionClaims = $expenses->where('status', 'under_review')->count();

    $submittedClaims = $submittedClaims ?? $expenses->count();
    $claimsNeedingAction = $claimsNeedingAction ?? ($pendingClaims + $revisionClaims);
@endphp

<style>
    .expense-hero {
        background: linear-gradient(135deg, #052e1b, #0f9f55);
        color: white;
        border-radius: 34px;
        padding: 34px;
        margin-bottom: 26px;
        display: flex;
        justify-content: space-between;
        gap: 24px;
        align-items: center;
        box-shadow: 0 24px 55px rgba(6, 59, 35, .20);
    }

    .expense-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 42px;
        letter-spacing: -1px;
    }

    .expense-hero p {
        margin: 0;
        color: #dcfce7;
        line-height: 1.7;
        max-width: 820px;
    }

    .expense-hero .eyebrow {
        color: #bbf7d0;
        letter-spacing: .14em;
        font-weight: 900;
        margin-bottom: 10px;
    }

    .hero-btn {
        background: white;
        color: #08783f;
        padding: 15px 24px;
        border-radius: 999px;
        font-weight: 900;
        text-decoration: none;
        white-space: nowrap;
    }

    .claim-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 26px;
    }

    .claim-kpi {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 28px;
        padding: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .claim-kpi span {
        color: #64748b;
        font-weight: 800;
        font-size: 14px;
    }

    .claim-kpi strong {
        display: block;
        color: #08783f;
        font-size: 34px;
        margin-top: 12px;
    }

    .claim-kpi p {
        margin: 8px 0 0;
        color: #64748b;
        line-height: 1.5;
    }

    .control-note {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        border-radius: 24px;
        padding: 20px 22px;
        margin-bottom: 24px;
        line-height: 1.7;
        box-shadow: 0 14px 35px rgba(15,23,42,.04);
    }

    .filter-card {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 28px;
        padding: 22px;
        margin-bottom: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .filter-card h3 {
        margin: 0 0 6px;
        color: #0b1f16;
        font-size: 24px;
    }

    .filter-card p {
        margin: 0 0 18px;
        color: #64748b;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr 1fr;
        gap: 14px;
    }

    .filter-grid input,
    .filter-grid select {
        width: 100%;
        border: 1px solid #cbd8d0;
        border-radius: 18px;
        padding: 14px 16px;
        font-size: 14px;
        outline: none;
    }

    .filter-grid input:focus,
    .filter-grid select:focus {
        border-color: #08783f;
        box-shadow: 0 0 0 4px rgba(8,120,63,.08);
    }

    .claim-ledger {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
        overflow-x: auto;
    }

    .ledger-head {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 18px;
        margin-bottom: 20px;
    }

    .ledger-head h3 {
        margin: 0;
        color: #0b1f16;
        font-size: 25px;
    }

    .ledger-head p {
        margin: 6px 0 0;
        color: #64748b;
    }

    .ledger-count {
        background: #e8fbef;
        color: #08783f;
        padding: 10px 16px;
        border-radius: 999px;
        font-weight: 900;
        white-space: nowrap;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1100px;
    }

    th {
        text-align: left;
        color: #64748b;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .10em;
        padding: 14px 12px;
        border-bottom: 1px solid #e5eee8;
        background: #f8fcfa;
    }

    td {
        padding: 18px 12px;
        border-bottom: 1px solid #eef5f0;
        color: #10231a;
        vertical-align: middle;
    }

    .claim-main strong {
        display: block;
        color: #0b1f16;
        margin-bottom: 5px;
    }

    .claim-main span {
        color: #64748b;
        font-size: 13px;
    }

    .amount-text {
        font-weight: 900;
        color: #08783f;
        font-size: 17px;
        white-space: nowrap;
    }

    .budget-mini {
        font-size: 13px;
        color: #64748b;
        line-height: 1.6;
    }

    .budget-mini strong {
        color: #0b1f16;
    }

    .receipt-link {
        display: inline-flex;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eefbf3;
        color: #08783f;
        text-decoration: none;
        font-weight: 900;
        font-size: 12px;
    }

    .receipt-missing {
        color: #94a3b8;
        font-size: 13px;
        font-weight: 700;
    }

    .status-pill {
        display: inline-flex;
        padding: 8px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .status-approved { background: #dcfce7; color: #166534; }
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-review { background: #e0f2fe; color: #075985; }
    .status-rejected { background: #fee2e2; color: #991b1b; }

    .details-btn {
        background: #08783f;
        color: white;
        padding: 11px 16px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 900;
        white-space: nowrap;
    }

    .empty-state {
        text-align: center;
        color: #64748b;
        padding: 34px;
    }

    .hide-row {
        display: none;
    }

    @media(max-width: 1100px) {
        .claim-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .expense-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media(max-width: 680px) {
        .claim-kpi-grid {
            grid-template-columns: 1fr;
        }

        .expense-hero h1 {
            font-size: 32px;
        }

        .ledger-head {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="expense-hero">
    <div>
        <p class="eyebrow">IMPACTRELIEF EXPENSE CONTROL</p>
        <h1>Expense Claims Centre</h1>
        <p>
            Staff submit expense claims against approved budget allocations only.
            Claims must stay within the remaining approved budget and require administrator verification.
        </p>
    </div>

    @if(auth()->user()->isStaff())
        <a href="{{ route('expenses.create') }}" class="hero-btn">
            + Submit Expense Claim
        </a>
    @endif
</div>

<div class="control-note">
    <strong>Financial Control Rule:</strong>
    every expense claim must be linked to an approved budget allocation.
    This prevents spending beyond approved limits and supports transparent fund governance.
</div>

<div class="claim-kpi-grid">
    <div class="claim-kpi">
        <span>Submitted Claims</span>
        <strong>{{ $submittedClaims }}</strong>
        <p>All expense claims submitted by staff.</p>
    </div>

    <div class="claim-kpi">
        <span>Requested Spending</span>
        <strong>RM{{ number_format($totalClaimed, 2) }}</strong>
        <p>Pending and under-review claim amount submitted for validation.</p>
    </div>

    <div class="claim-kpi">
        <span>Approved Budget Usage</span>
        <strong>RM{{ number_format($approvedClaimed, 2) }}</strong>
        <p>Verified claims approved by admin.</p>
    </div>

    <div class="claim-kpi">
        <span>Claims Needing Action</span>
        <strong>{{ $claimsNeedingAction }}</strong>
        <p>Pending or under-review claims.</p>
    </div>
</div>

<div class="filter-card">
    <h3>Filter Claims</h3>
    <p>Search claim records by campaign, allocation purpose, vendor or status.</p>

    <div class="filter-grid">
        <input type="text" id="searchInput" placeholder="Search campaign, purpose, vendor...">

        <select id="statusFilter">
            <option value="">All Status</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="under_review">Under Review</option>
            <option value="rejected">Rejected</option>
        </select>

        <select id="receiptFilter">
            <option value="">All Receipt Status</option>
            <option value="yes">With Receipt</option>
            <option value="no">No Receipt</option>
        </select>
    </div>
</div>

<div class="claim-ledger">
    <div class="ledger-head">
        <div>
            <h3>Expense Claim Ledger</h3>
            <p>
                Track each claim against its approved budget allocation, receipt evidence and review status.
            </p>
        </div>

        <div class="ledger-count">
            {{ $expenses->count() }} Claims
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th>Claim ID</th>
            <th>Campaign & Allocation</th>
            <th>Claim Amount</th>
            <th>Budget Reference</th>
            <th>Vendor</th>
            <th>Receipt</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @forelse($expenses as $expense)
            @php
                $allocation = $expense->fundAllocation;
                $approvedBudget = $allocation->amount ?? 0;

                $approvedUsed = $allocation
                    ? \App\Models\Expense::where('fund_allocation_id', $allocation->id)
                        ->where('status', 'approved')
                        ->sum('amount')
                    : 0;

                $remaining = max($approvedBudget - $approvedUsed, 0);

                $campaignName = $expense->campaign->title ?? 'Campaign #' . ($expense->campaign_id ?? '-');
                $purposeName = $allocation->purpose->name ?? 'No allocation purpose';
                $vendorName = $expense->vendor ?? '-';
                $receiptStatus = $expense->receipt ? 'yes' : 'no';
            @endphp

            <tr class="claim-row"
                data-search="{{ strtolower($campaignName . ' ' . $purposeName . ' ' . $vendorName . ' ' . $expense->status) }}"
                data-status="{{ strtolower($expense->status) }}"
                data-receipt="{{ $receiptStatus }}">

                <td>#{{ $expense->id }}</td>

                <td class="claim-main">
                    <strong>{{ $campaignName }}</strong>
                    <span>{{ $purposeName }}</span>
                </td>

                <td>
                    <span class="amount-text">
                        RM{{ number_format($expense->amount, 2) }}
                    </span>
                </td>

                <td>
                    <div class="budget-mini">
                        Allocation: <strong>#{{ $allocation->id ?? 'Not linked' }}</strong><br>
                        Budget: <strong>RM{{ number_format($approvedBudget, 2) }}</strong><br>
                        Remaining: <strong>RM{{ number_format($remaining, 2) }}</strong>
                    </div>
                </td>

                <td>{{ $vendorName }}</td>

                <td>
                    @if($expense->receipt)
                        <a href="{{ asset('storage/' . $expense->receipt) }}"
                           target="_blank"
                           class="receipt-link">
                            View Receipt
                        </a>
                    @else
                        <span class="receipt-missing">No receipt</span>
                    @endif
                </td>

                <td>
                    @if($expense->status == 'approved')
                        <span class="status-pill status-approved">Approved</span>
                    @elseif($expense->status == 'pending')
                        <span class="status-pill status-pending">Pending</span>
                    @elseif($expense->status == 'under_review')
                        <span class="status-pill status-review">Under Review</span>
                    @else
                        <span class="status-pill status-rejected">Rejected</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('expenses.show', $expense) }}"
                       class="details-btn">
                        Review
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="empty-state">
                    No expense claim record found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const receiptFilter = document.getElementById('receiptFilter');
    const rows = document.querySelectorAll('.claim-row');

    function filterClaims() {
        const search = searchInput.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();
        const receipt = receiptFilter.value.toLowerCase();

        rows.forEach(row => {
            const rowSearch = row.dataset.search || '';
            const rowStatus = row.dataset.status || '';
            const rowReceipt = row.dataset.receipt || '';

            const matchSearch = rowSearch.includes(search);
            const matchStatus = !status || rowStatus === status;
            const matchReceipt = !receipt || rowReceipt === receipt;

            row.classList.toggle('hide-row', !(matchSearch && matchStatus && matchReceipt));
        });
    }

    searchInput.addEventListener('input', filterClaims);
    statusFilter.addEventListener('change', filterClaims);
    receiptFilter.addEventListener('change', filterClaims);
</script>

@endsection