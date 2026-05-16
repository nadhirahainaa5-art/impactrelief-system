@extends('layouts.app')

@section('title', 'Budget Allocation Centre')
@section('page_title', 'Budget Allocation Centre')

@section('content')

@php
    $approvedBudget = $allocations
        ->where('status', 'approved')
        ->sum('amount');

    $pendingCount = $allocations->where('status', 'pending')->count();
    $reviewCount = $allocations->where('status', 'under_review')->count();
@endphp

<style>
    .allocation-hero {
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

    .allocation-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 42px;
        letter-spacing: -1px;
    }

    .allocation-hero p {
        margin: 0;
        color: #dcfce7;
        line-height: 1.7;
        max-width: 780px;
    }

    .allocation-hero .eyebrow {
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

    .workflow-card {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .workflow-title {
        margin: 0 0 18px;
        font-size: 22px;
        color: #0b1f16;
    }

    .workflow-steps {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
    }

    .step-box {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 20px;
        padding: 18px;
    }

    .step-number {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        background: #e8fbef;
        color: #08783f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        margin-bottom: 12px;
    }

    .step-box strong {
        display: block;
        color: #0b1f16;
        margin-bottom: 6px;
    }

    .step-box span {
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
    }

    .allocation-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 26px;
    }

    .allocation-kpi {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 28px;
        padding: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .allocation-kpi span {
        color: #64748b;
        font-weight: 800;
        font-size: 14px;
    }

    .allocation-kpi strong {
        display: block;
        color: #08783f;
        font-size: 34px;
        margin-top: 12px;
    }

    .allocation-kpi p {
        margin: 8px 0 0;
        color: #64748b;
        line-height: 1.5;
    }

    .budget-ledger {
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

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 920px;
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

    .budget-purpose strong {
        display: block;
        color: #0b1f16;
        margin-bottom: 5px;
    }

    .budget-purpose span {
        color: #64748b;
        font-size: 13px;
    }

    .amount-text {
        font-weight: 900;
        color: #08783f;
        font-size: 17px;
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

    .closed-btn {
        background: #cbd5e1;
        color: white;
        padding: 11px 16px;
        border-radius: 999px;
        font-weight: 900;
        display: inline-flex;
    }

    .muted-row {
        opacity: .55;
    }

    .empty-state {
        text-align: center;
        color: #64748b;
        padding: 34px;
    }

    @media(max-width: 1100px) {
        .workflow-steps,
        .allocation-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .allocation-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media(max-width: 680px) {
        .workflow-steps,
        .allocation-kpi-grid {
            grid-template-columns: 1fr;
        }

        .allocation-hero h1 {
            font-size: 32px;
        }

        .ledger-head {
            flex-direction: column;
            align-items: flex-start;
        }
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
    grid-template-columns: 1.4fr 1fr;
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

.hide-row {
    display: none;
}

@media(max-width: 680px) {
    .filter-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="allocation-hero">
    <div>
        <p class="eyebrow">IMPACTRELIEF BUDGET CONTROL</p>
        <h1>Budget Allocation Centre</h1>
        <p>
            Staff create budget allocation requests before any expense claim can be submitted.
            Only approved budgets can be used for spending, claims and financial reporting.
        </p>
    </div>

    @if(auth()->user()->isStaff())
        <a href="{{ route('fund-allocations.create') }}" class="hero-btn">
            + Create Budget Request
        </a>
    @endif
</div>

<div class="workflow-card">
    <h3 class="workflow-title">Financial Control Workflow</h3>

    <div class="workflow-steps">
        <div class="step-box">
            <div class="step-number">1</div>
            <strong>Donation Received</strong>
            <span>Campaign receives public contribution from donors.</span>
        </div>

        <div class="step-box">
            <div class="step-number">2</div>
            <strong>Budget Request</strong>
            <span>Staff requests budget allocation for a specific campaign purpose.</span>
        </div>

        <div class="step-box">
            <div class="step-number">3</div>
            <strong>Admin Approval</strong>
            <span>Admin approves, rejects or requests revision.</span>
        </div>

        <div class="step-box">
            <div class="step-number">4</div>
            <strong>Expense Claim</strong>
            <span>Staff submits expenses only from approved budgets.</span>
        </div>

        <div class="step-box">
            <div class="step-number">5</div>
            <strong>Reporting</strong>
            <span>Approved usage becomes part of fund transparency records.</span>
        </div>
    </div>
</div>

<div class="allocation-kpi-grid">
    <div class="allocation-kpi">
        <span>Total Budget Requests</span>
        <strong>{{ $allocations->count() }}</strong>
        <p>All budget allocation records submitted.</p>
    </div>

    <div class="allocation-kpi">
        <span>Approved Budget</span>
        <strong>RM{{ number_format($approvedBudget, 2) }}</strong>
        <p>Budget approved and available for expense claims.</p>
    </div>

    <div class="allocation-kpi">
        <span>Pending Approval</span>
        <strong>{{ $pendingCount }}</strong>
        <p>Budget requests waiting for admin decision.</p>
    </div>

    <div class="allocation-kpi">
        <span>Needs Revision</span>
        <strong>{{ $reviewCount }}</strong>
        <p>Requests returned for staff updates or clarification.</p>
    </div>
</div>
<div class="filter-card">
    <h3>Filter Budget Requests</h3>
    <p>Search by campaign, purpose or approval status.</p>

    <div class="filter-grid">
        <input type="text" id="searchInput" placeholder="Search campaign or purpose...">

        <select id="statusFilter">
            <option value="">All Status</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="under_review">Under Review</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>
</div>

<div class="budget-ledger">
    <div class="ledger-head">
        <div>
            <h3>Budget Allocation Ledger</h3>
            <p>
                Approved allocation records become the spending limit for future expense submissions.
            </p>
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th>Campaign</th>
            <th>Budget Amount</th>
            <th>Purpose</th>
            <th>Approval Status</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @forelse($allocations as $allocation)
            @php
                $isFinal = in_array($allocation->status, ['approved', 'rejected']);

                if(auth()->user()->isAdmin()){
                    $canOpen = !$isFinal;
                } else {
                    $canOpen = in_array($allocation->status, ['pending', 'under_review']);
                }
            @endphp

            <tr class="allocation-row {{ !$canOpen ? 'muted-row' : '' }}"
    data-search="{{ strtolower(($allocation->campaign->title ?? '') . ' ' . ($allocation->purpose->name ?? '') . ' ' . $allocation->status) }}"
    data-status="{{ strtolower($allocation->status) }}">
                <td>{{ $loop->iteration }}</td>

                <td class="budget-purpose">
                    <strong>{{ $allocation->campaign->title ?? 'Campaign Deleted' }}</strong>
                    <span>Campaign budget request</span>
                </td>

                <td>
                    <span class="amount-text">
                        RM{{ number_format($allocation->amount, 2) }}
                    </span>
                </td>

                <td>
                    {{ $allocation->purpose->name ?? '-' }}
                </td>

                <td>
                    @if($allocation->status == 'approved')
                        <span class="status-pill status-approved">Approved Budget</span>
                    @elseif($allocation->status == 'pending')
                        <span class="status-pill status-pending">Pending Approval</span>
                    @elseif($allocation->status == 'under_review')
                        <span class="status-pill status-review">Needs Revision</span>
                    @else
                        <span class="status-pill status-rejected">Rejected</span>
                    @endif
                </td>

                <td>
                    @if($canOpen)
                        <a href="{{ route('fund-allocations.show', $allocation) }}"
                           class="details-btn">
                            Review
                        </a>
                    @else
                        <span class="closed-btn">
                            Locked
                        </span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="empty-state">
                    No budget allocation request found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
<script>
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('.allocation-row');

    function filterAllocations() {
        const search = searchInput.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();

        rows.forEach(row => {
            const rowSearch = row.dataset.search || '';
            const rowStatus = row.dataset.status || '';

            const matchSearch = rowSearch.includes(search);
            const matchStatus = !status || rowStatus === status;

            row.classList.toggle('hide-row', !(matchSearch && matchStatus));
        });
    }

    searchInput.addEventListener('input', filterAllocations);
    statusFilter.addEventListener('change', filterAllocations);
</script>
@endsection