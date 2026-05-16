@extends('layouts.app')

@section('title', 'Expense Claim Review')
@section('page_title', 'Expense Claim Review')

@section('content')

@php
    $allocation = $expense->fundAllocation;
    $approvedBudget = $allocation->amount ?? 0;

    $approvedUsed = $allocation
        ? \App\Models\Expense::where('fund_allocation_id', $allocation->id)
            ->where('status', 'approved')
            ->sum('amount')
        : 0;

    $remaining = max($approvedBudget - $approvedUsed, 0);
@endphp

<style>
    .claim-review-hero {
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

    .claim-review-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 42px;
    }

    .claim-review-hero p {
        margin: 0;
        color: #dcfce7;
        line-height: 1.7;
        max-width: 780px;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .hero-btn {
        background: white;
        color: #08783f;
        padding: 14px 22px;
        border-radius: 999px;
        font-weight: 900;
        text-decoration: none;
        white-space: nowrap;
    }

    .hero-btn-outline {
        border: 1px solid rgba(255,255,255,.4);
        color: white;
        padding: 14px 22px;
        border-radius: 999px;
        font-weight: 900;
        text-decoration: none;
        white-space: nowrap;
    }

    .review-layout {
        display: grid;
        grid-template-columns: 1fr .8fr;
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

    .description-box {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 22px;
        padding: 20px;
        color: #475569;
        line-height: 1.7;
    }

    .receipt-box {
        background: #f4fbf7;
        border: 1px solid #dbeee3;
        border-radius: 24px;
        padding: 22px;
        text-align: center;
    }

    .receipt-box strong {
        display: block;
        color: #0b1f16;
        margin-bottom: 10px;
    }

    .receipt-link {
        display: inline-flex;
        margin-top: 12px;
        background: #08783f;
        color: white;
        padding: 12px 18px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 900;
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

    .action-approve {
        background: #08783f;
        color: white;
    }

    .action-review {
        background: #f59e0b;
        color: white;
    }

    .action-reject {
        background: #dc2626;
        color: white;
    }

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

        .claim-review-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media(max-width: 620px) {
        .detail-grid-premium {
            grid-template-columns: 1fr;
        }

        .claim-review-hero h1 {
            font-size: 32px;
        }
    }
</style>

<div class="claim-review-hero">
    <div>
        <p class="eyebrow" style="color:#bbf7d0;">IMPACTRELIEF FINANCE REVIEW</p>
        <h1>Expense Claim #{{ $expense->id }}</h1>
        <p>
            Review the claim amount, approved budget allocation, supporting receipt and
            administrator decision before finalising fund usage.
        </p>
    </div>

    <div class="hero-actions">
        <a href="{{ route('expenses.index') }}" class="hero-btn-outline">
            Back to Claims
        </a>

        @if(auth()->user()->isStaff() && in_array($expense->status, ['pending', 'under_review']))
            <a href="{{ route('expenses.edit', $expense) }}" class="hero-btn">
                Edit Claim
            </a>
        @endif
    </div>
</div>

@if($expense->review_comment)
    <div class="admin-comment">
        <strong>Admin Review Comment:</strong><br>
        {{ $expense->review_comment }}
    </div>
@endif

<div class="review-layout">

    <div>
        <div class="review-card">
            <h3>Claim Information</h3>

            <div class="detail-grid-premium">
                <div class="detail-box-premium">
                    <span>Claim ID</span>
                    <strong>#{{ $expense->id }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Status</span>

                    @if($expense->status == 'approved')
                        <span class="status-pill status-approved">Approved</span>
                    @elseif($expense->status == 'pending')
                        <span class="status-pill status-pending">Pending Review</span>
                    @elseif($expense->status == 'under_review')
                        <span class="status-pill status-review">Needs Revision</span>
                    @else
                        <span class="status-pill status-rejected">Rejected</span>
                    @endif
                </div>

                <div class="detail-box-premium">
                    <span>Campaign</span>
                    <strong>{{ $expense->campaign->title ?? 'Campaign Deleted' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Claim Amount</span>
                    <strong>RM{{ number_format($expense->amount, 2) }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Expense Purpose</span>
                    <strong>{{ $expense->expense_type ?? '-' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Expense Date</span>
                    <strong>{{ $expense->expense_date ? $expense->expense_date->format('d M Y') : '-' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Vendor / Supplier</span>
                    <strong>{{ $expense->vendor ?? '-' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Submitted By</span>
                    <strong>{{ $expense->submitter->name ?? '-' }}</strong>
                </div>
            </div>
        </div>

        <div class="review-card">
            <h3>Claim Description</h3>

            <div class="description-box">
                {{ $expense->description ?: 'No description provided.' }}
            </div>
        </div>

        <div class="review-card">
            <h3>Receipt Evidence</h3>

            <div class="receipt-box">
                @if($expense->receipt)
                    <strong>Receipt file uploaded</strong>
                    <p class="muted">Supporting document is available for finance verification.</p>

                    <a href="{{ asset('storage/' . $expense->receipt) }}"
                       target="_blank"
                       class="receipt-link">
                        View Receipt
                    </a>
                @else
                    <strong>No receipt uploaded</strong>
                    <p class="muted">This claim does not include receipt evidence.</p>
                @endif
            </div>
        </div>
    </div>

    <div>
        <div class="review-card">
            <h3>Budget Allocation Reference</h3>

            <div class="detail-grid-premium">
                <div class="detail-box-premium">
                    <span>Allocation ID</span>
                    <strong>#{{ $allocation->id ?? 'Not Linked' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Purpose</span>
                    <strong>{{ $allocation->purpose->name ?? '-' }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Approved Budget</span>
                    <strong>RM{{ number_format($approvedBudget, 2) }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Approved Claims Used</span>
                    <strong>RM{{ number_format($approvedUsed, 2) }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Remaining Balance</span>
                    <strong>RM{{ number_format($remaining, 2) }}</strong>
                </div>

                <div class="detail-box-premium">
                    <span>Control Rule</span>
                    <strong>Claim ≤ Remaining Budget</strong>
                </div>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
            <div class="review-card">
                <h3>Admin Decision</h3>

                @if(in_array($expense->status, ['approved', 'rejected']))
                    <div class="locked-review">
                        This claim has already been {{ $expense->status }} and is locked for further review action.
                    </div>
                @else
                    <div class="review-actions">
                        <form method="POST" action="{{ route('expenses.approve', $expense) }}">
                            @csrf
                            <button type="submit" class="action-approve">
                                Approve Claim
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
                            Reject Claim
                        </button>
                    </div>

                    <div id="reviewBox" class="review-form" style="display:none;">
                        <form method="POST" action="{{ route('expenses.review', $expense) }}">
                            @csrf

                            <label>Review Comment</label>
                            <textarea name="review_comment" rows="4" required></textarea>

                            <button type="submit" class="action-review">
                                Submit Review Comment
                            </button>
                        </form>
                    </div>

                    <div id="rejectBox" class="review-form" style="display:none;">
                        <form method="POST" action="{{ route('expenses.reject', $expense) }}">
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