@extends('layouts.app')

@section('title', 'Budget Approval Review')
@section('page_title', 'Budget Approval Review')

@section('content')

@php
    $approvedUsed = \App\Models\Expense::where('fund_allocation_id', $fundAllocation->id)
        ->where('status', 'approved')
        ->sum('amount');

    $pendingClaims = \App\Models\Expense::where('fund_allocation_id', $fundAllocation->id)
        ->where('status', 'pending')
        ->count();

    $remaining = max($fundAllocation->amount - $approvedUsed, 0);
@endphp

<style>
    .budget-review-hero {
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

    .budget-review-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 42px;
    }

    .budget-review-hero p {
        margin: 0;
        color: #dcfce7;
        line-height: 1.7;
        max-width: 820px;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .hero-btn,
    .hero-btn-outline {
        padding: 14px 22px;
        border-radius: 999px;
        font-weight: 900;
        text-decoration: none;
        white-space: nowrap;
    }

    .hero-btn {
        background: white;
        color: #08783f;
    }

    .hero-btn-outline {
        border: 1px solid rgba(255,255,255,.4);
        color: white;
    }

    .review-layout {
        display: grid;
        grid-template-columns: 1fr .85fr;
        gap: 24px;
    }

    .review-card {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 26px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
        margin-bottom: 24px;
    }

    .review-card h3 {
        margin: 0 0 18px;
        color: #0b1f16;
        font-size: 24px;
    }

    .detail-grid-premium {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .detail-box-premium {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 20px;
        padding: 18px;
    }

    .detail-box-premium span {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 7px;
        font-weight: 700;
    }

    .detail-box-premium strong {
        color: #08783f;
        font-size: 20px;
        word-break: break-word;
    }

    .status-pill {
        display: inline-flex;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
        text-transform: uppercase;
    }

    .status-approved { background: #dcfce7; color: #166534; }
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-review { background: #e0f2fe; color: #075985; }
    .status-rejected { background: #fee2e2; color: #991b1b; }

    .note-box {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 22px;
        padding: 20px;
        color: #475569;
        line-height: 1.7;
    }

    .admin-comment {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        border-radius: 22px;
        padding: 18px;
        line-height: 1.7;
        margin-bottom: 24px;
    }

    .usage-card {
        background: linear-gradient(135deg, #f8fcfa, #ffffff);
        border: 1px solid #dbeee3;
        border-radius: 24px;
        padding: 20px;
        margin-bottom: 14px;
    }

    .usage-card span {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 6px;
        font-weight: 800;
    }

    .usage-card strong {
        color: #08783f;
        font-size: 24px;
    }

    .progress-track {
        height: 10px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
        margin-top: 14px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #08783f, #22c55e);
        border-radius: 999px;
    }

    .review-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .action-approve,
    .action-review,
    .action-reject {
        border: none;
        padding: 13px 18px;
        border-radius: 999px;
        font-weight: 900;
        cursor: pointer;
    }

    .action-approve { background: #08783f; color: white; }
    .action-review { background: #f59e0b; color: white; }
    .action-reject { background: #dc2626; color: white; }

    .review-form {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 22px;
        padding: 20px;
        margin-top: 16px;
    }

    .review-form label {
        display: block;
        font-weight: 900;
        color: #0b1f16;
        margin-bottom: 8px;
    }

    .review-form textarea {
        width: 100%;
        border: 1px solid #cbd8d0;
        border-radius: 18px;
        padding: 15px;
        font-size: 15px;
        margin-bottom: 14px;
    }

    .locked-review {
        background: #f1f5f9;
        color: #64748b;
        border-radius: 22px;
        padding: 18px;
        line-height: 1.7;
        font-weight: 700;
    }

    @media(max-width: 950px) {
        .review-layout {
            grid-template-columns: 1fr;
        }

        .budget-review-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media(max-width: 620px) {
        .detail-grid-premium {
            grid-template-columns: 1fr;
        }

        .budget-review-hero h1 {
            font-size: 32px;
        }
    }
</style>

<div class="budget-review-hero">
    <div>
        <p class="eyebrow" style="color:#bbf7d0;">IMPACTRELIEF BUDGET REVIEW</p>
        <h1>Budget Request #{{ $fundAllocation->id }}</h1>
        <p>
            Review the requested budget allocation, purpose, campaign context and usage control
            before allowing staff to submit expense claims against this budget.
        </p>
    </div>

    <div class="hero-actions">
        <a href="{{ route('fund-allocations.index') }}" class="hero-btn-outline">
            Back to Budget Centre
        </a>

        @if(auth()->user()->isStaff() && in_array($fundAllocation->status, ['pending', 'under_review']))
            <a href="{{ route('fund-allocations.edit', $fundAllocation) }}" class="hero-btn">
                Edit Request
            </a>
        @endif
    </div>
</div>

@if($fundAllocation->review_comment)
    <div class="admin-comment">
        <strong>Admin Review Comment:</strong><br>
        {{ $fundAllocation->review_comment }}
    </div>
@endif

<div class="review-layout">

    <div>
        <div class="review-card">
            <h3>Budget Request Information</h3>

            <div class="detail-grid-premium">
                <div class="detail-box-premium">
                    <span>Budget Request ID</span>
                    <strong>#{{ $fundAllocation->id }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Status</span>

                    @if($fundAllocation->status == 'approved')
                        <span class="status-pill status-approved">Approved Budget</span>
                    @elseif($fundAllocation->status == 'pending')
                        <span class="status-pill status-pending">Pending Approval</span>
                    @elseif($fundAllocation->status == 'under_review')
                        <span class="status-pill status-review">Needs Revision</span>
                    @else
                        <span class="status-pill status-rejected">Rejected</span>
                    @endif
                </div>

                <div class="detail-box-premium">
                    <span>Campaign</span>
                    <strong>{{ $fundAllocation->campaign->title ?? 'Campaign Deleted' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Budget Purpose</span>
                    <strong>{{ $fundAllocation->purpose->name ?? '-' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Requested Amount</span>
                    <strong>RM{{ number_format($fundAllocation->amount, 2) }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Allocation Date</span>
                    <strong>{{ $fundAllocation->allocation_date ? $fundAllocation->allocation_date->format('d M Y') : '-' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Reference No</span>
                    <strong>{{ $fundAllocation->reference_no ?? '-' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Approved At</span>
                    <strong>{{ $fundAllocation->approved_at ? $fundAllocation->approved_at->format('d M Y') : '-' }}</strong>
                </div>
            </div>
        </div>

        <div class="review-card">
            <h3>Budget Justification</h3>

            <div class="note-box">
                {{ $fundAllocation->note ?: 'No justification note provided.' }}
            </div>
        </div>
    </div>

    <div>
        <div class="review-card">
            <h3>Usage Control Summary</h3>

            @php
                $usagePercent = $fundAllocation->amount > 0
                    ? min(100, round(($approvedUsed / $fundAllocation->amount) * 100))
                    : 0;
            @endphp

            <div class="usage-card">
                <span>Approved Budget</span>
                <strong>RM{{ number_format($fundAllocation->amount, 2) }}</strong>
            </div>

            <div class="usage-card">
                <span>Approved Expense Claims Used</span>
                <strong>RM{{ number_format($approvedUsed, 2) }}</strong>
            </div>

            <div class="usage-card">
                <span>Remaining Claimable Balance</span>
                <strong>RM{{ number_format($remaining, 2) }}</strong>

                <div class="progress-track">
                    <div class="progress-fill" style="width: {{ $usagePercent }}%;"></div>
                </div>
            </div>

            <div class="usage-card">
                <span>Pending Claims Against This Budget</span>
                <strong>{{ $pendingClaims }}</strong>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
            <div class="review-card">
                <h3>Admin Decision</h3>

                @if(in_array($fundAllocation->status, ['approved', 'rejected']))
                    <div class="locked-review">
                        This budget request has already been {{ $fundAllocation->status }} and is locked for further review action.
                    </div>
                @else
                    <div class="review-actions">
                        <form method="POST" action="{{ route('fund-allocations.approve', $fundAllocation) }}">
                            @csrf
                            <button type="submit" class="action-approve">
                                Approve Budget
                            </button>
                        </form>

                        <button type="button"
                                class="action-review"
                                onclick="document.getElementById('reviewBox').style.display='block'; document.getElementById('rejectBox').style.display='none';">
                            Mark Under Review
                        </button>

                        <button type="button"
                                class="action-reject"
                                onclick="document.getElementById('rejectBox').style.display='block'; document.getElementById('reviewBox').style.display='none';">
                            Reject Budget
                        </button>
                    </div>

                    <div id="reviewBox" class="review-form" style="display:none;">
                        <form method="POST" action="{{ route('fund-allocations.review', $fundAllocation) }}">
                            @csrf

                            <label>Review Comment</label>
                            <textarea name="review_comment" rows="4" required></textarea>

                            <button type="submit" class="action-review">
                                Submit Review Comment
                            </button>
                        </form>
                    </div>

                    <div id="rejectBox" class="review-form" style="display:none;">
                        <form method="POST" action="{{ route('fund-allocations.reject', $fundAllocation) }}">
                            @csrf

                            <label>Reject Reason</label>
                            <textarea name="review_comment" rows="4" required></textarea>

                            <button type="submit" class="action-reject">
                                Submit Rejection
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @endif
    </div>

</div>

@endsection