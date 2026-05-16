@extends('layouts.app')

@section('title', $campaign->title)
@section('page_title', 'Campaign Review')

@section('content')

@php
    $raised = $campaign->amount_raised ?? 0;
    $goal = $campaign->funding_goal ?? 0;
    $used = $campaign->amount_used ?? 0;
    $balance = max($raised - $used, 0);
    $percent = $goal > 0 ? min(($raised / $goal) * 100, 100) : 0;

    $canAdminReview = auth()->user()->isAdmin()
        && in_array($campaign->status, ['pending', 'under_review']);
@endphp

<style>
    .campaign-hero {
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

    .campaign-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 42px;
        letter-spacing: -1px;
    }

    .campaign-hero p {
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

    .campaign-layout {
        display: grid;
        grid-template-columns: 1fr .85fr;
        gap: 24px;
    }

    .campaign-card {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 26px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
        margin-bottom: 24px;
    }

    .cover-panel {
        height: 240px;
        border-radius: 28px;
        background:
            linear-gradient(rgba(5,46,27,.55), rgba(5,46,27,.55)),
            linear-gradient(135deg, #08783f, #22c55e);
        display: flex;
        align-items: flex-end;
        padding: 28px;
        color: white;
        margin-bottom: 24px;
    }

    .cover-panel h2 {
        color: white;
        margin: 0;
        font-size: 34px;
        max-width: 720px;
    }

    .campaign-card h3 {
        margin: 0 0 18px;
        color: #0b1f16;
        font-size: 24px;
    }

    .description-box {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 22px;
        padding: 20px;
        color: #475569;
        line-height: 1.8;
    }
.description-box p {
    margin: 0 0 16px;
}

.description-box p:last-child {
    margin-bottom: 0;
}
    .progress-section {
        margin-top: 22px;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        color: #0b1f16;
        font-weight: 900;
        margin-bottom: 10px;
    }

    .progress-track {
        height: 12px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #08783f, #22c55e);
        border-radius: 999px;
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

    .info-stack {
        display: grid;
        gap: 14px;
    }

    .info-row {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 20px;
        padding: 18px;
        display: flex;
        justify-content: space-between;
        gap: 18px;
        align-items: center;
    }

    .info-row span {
        color: #64748b;
        font-size: 14px;
        font-weight: 800;
    }

    .info-row strong {
        color: #08783f;
        font-size: 20px;
        white-space: nowrap;
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
        .campaign-layout {
            grid-template-columns: 1fr;
        }

        .campaign-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media(max-width: 620px) {
        .detail-grid-premium {
            grid-template-columns: 1fr;
        }

        .campaign-hero h1 {
            font-size: 32px;
        }

        .cover-panel h2 {
            font-size: 26px;
        }
    }
</style>

<div class="campaign-hero">
    <div>
        <p class="eyebrow" style="color:#bbf7d0;">IMPACTRELIEF CAMPAIGN REVIEW</p>

        <h1>{{ $campaign->title }}</h1>

        <p>
            Review campaign readiness, funding target, donation progress and approval status
            before making this campaign visible for public donation.
        </p>
    </div>

    <div class="hero-actions">

        <a href="{{ route('campaigns.index') }}" class="hero-btn-outline">
            Back to Campaigns
        </a>

        @if(auth()->user()->isStaff() && $campaign->created_by == auth()->id() && in_array($campaign->status, ['pending', 'under_review']))

            <a href="{{ route('campaigns.edit', $campaign) }}" class="hero-btn">
                Edit Campaign
            </a>

        @endif
    </div>
</div>

@if($campaign->review_comment)

    <div class="admin-comment">
        <strong>Admin Review Comment:</strong><br>
        {{ $campaign->review_comment }}
    </div>

@endif

<div class="campaign-layout">

    <div>

        <div class="campaign-card">

            @if($campaign->poster_path)

                <div class="cover-panel"
                     style="background:
                        linear-gradient(rgba(5,46,27,.45), rgba(5,46,27,.45)),
                        url('{{ asset('storage/' . $campaign->poster_path) }}');
                        background-size: cover;
                        background-position: center;">

                    <h2>{{ $campaign->title }}</h2>

                </div>

            @else

                <div class="cover-panel">
                    <h2>{{ $campaign->title }}</h2>
                </div>

            @endif

            <h2>Campaign Overview</h2>

@if($campaign->tagline)
    <p style="font-size:18px; font-weight:700; color:#08783f;">
        {{ $campaign->tagline }}
    </p>
@endif

@if($campaign->campaign_story)
    <p style="line-height:1.8;">
        {!! nl2br(e($campaign->campaign_story)) !!}
    </p>
@elseif($campaign->description)
    <p style="line-height:1.8;">
        {!! nl2br(e($campaign->description)) !!}
    </p>
@else
    <p>No campaign story has been provided yet.</p>
@endif

@if($campaign->donation_usage)
    <h2>Donation Usage Plan</h2>

    <div style="
        background:#f0fdf4;
        border:1px solid #bbf7d0;
        padding:20px;
        border-radius:18px;
        line-height:1.8;
        color:#14532d;
    ">
        {!! nl2br(e($campaign->donation_usage)) !!}
    </div>
@endif
@if($campaign->youtube_url)
    <h2>Campaign Video</h2>

    <div style="
        aspect-ratio:16/9;
        border-radius:20px;
        overflow:hidden;
        background:#0f172a;
        margin-top:15px;
    ">
        <iframe
            src="{{ $campaign->youtube_url }}"
            style="width:100%; height:100%; border:0;"
            allowfullscreen>
        </iframe>
    </div>
@endif

            <div class="progress-section">

                <div class="progress-label">
                    <span>Donation Progress</span>
                    <span>{{ number_format($percent, 0) }}%</span>
                </div>

                <div class="progress-track">
                    <div class="progress-fill" style="width: {{ $percent }}%;"></div>
                </div>

            </div>
        </div>

        <!-- UPDATED CAMPAIGN DETAILS -->

        <div class="campaign-card">

            <h3>Campaign Details</h3>

            <div class="detail-grid-premium">

                <div class="detail-box-premium">
                    <span>Campaign Status</span>

                    @if($campaign->status == 'approved')
                        <span class="status-pill status-approved">Approved</span>

                    @elseif($campaign->status == 'pending')
                        <span class="status-pill status-pending">Pending Review</span>

                    @elseif($campaign->status == 'under_review')
                        <span class="status-pill status-review">Needs Revision</span>

                    @else
                        <span class="status-pill status-rejected">Rejected</span>

                    @endif
                </div>

                <div class="detail-box-premium">
                    <span>Campaign Duration</span>

                    <strong>
                        {{ $campaign->start_date ? $campaign->start_date->format('d M Y') : '-' }}
                        -
                        {{ $campaign->end_date ? $campaign->end_date->format('d M Y') : '-' }}
                    </strong>
                </div>

                <div class="detail-box-premium">
                    <span>Target Beneficiaries</span>

                    <strong>
                        {{ $campaign->target_beneficiaries ?? '-' }}
                    </strong>
                </div>

                <div class="detail-box-premium">
                    <span>Total Expense Claims</span>

                    <strong>
                        {{ $campaign->expenses()->count() }}
                    </strong>
                </div>

                <div class="detail-box-premium">
                    <span>Approved Claims</span>

                    <strong>
                        {{ $campaign->expenses()
                            ->where('status', 'approved')
                            ->count()
                        }}
                    </strong>
                </div>

                <div class="detail-box-premium">
                    <span>Last Expense Activity</span>

                    <strong>

                        @if($campaign->expenses()->exists())

                            {{ \Carbon\Carbon::parse(
                                $campaign->expenses()
                                    ->latest('expense_date')
                                    ->value('expense_date')
                            )->format('d M Y') }}

                        @else

                            No activity yet

                        @endif

                    </strong>
                </div>

            </div>

        </div>

    </div>

    <div>

        <div class="campaign-card">

            <h3>Financial Snapshot</h3>

            <div class="info-stack">

                <div class="info-row">
                    <span>Total Target</span>
                    <strong>RM{{ number_format($goal, 2) }}</strong>
                </div>

                <div class="info-row">
                    <span>Collected Donations</span>
                    <strong>RM{{ number_format($raised, 2) }}</strong>
                </div>

                <div class="info-row">
                    <span>Approved Expense Usage</span>
                    <strong>RM{{ number_format($used, 2) }}</strong>
                </div>

                <div class="info-row">
                    <span>Remaining Fund Balance</span>
                    <strong>RM{{ number_format($balance, 2) }}</strong>
                </div>

            </div>

        </div>

        @if(auth()->user()->isAdmin())

            <div class="campaign-card">

                <h3>Admin Decision</h3>

                @if(in_array($campaign->status, ['approved', 'rejected']))

                    <div class="locked-review">
                        This campaign has already been {{ $campaign->status }}
                        and is locked for further review action.
                    </div>

                @elseif($canAdminReview)

                    <div class="review-actions">

                        <form method="POST" action="{{ route('campaigns.approve', $campaign) }}">
                            @csrf

                            <button type="submit" class="action-approve">
                                Approve Campaign
                            </button>
                        </form>

                        <button type="button"
                                class="action-review"
                                onclick="document.getElementById('review-box').style.display='block'; document.getElementById('reject-box').style.display='none';">
                            Mark Under Review
                        </button>

                        <button type="button"
                                class="action-reject"
                                onclick="document.getElementById('reject-box').style.display='block'; document.getElementById('review-box').style.display='none';">
                            Reject Campaign
                        </button>

                    </div>

                    <div id="review-box" class="review-form" style="display:none;">

                        <form method="POST" action="{{ route('campaigns.review', $campaign) }}">
                            @csrf

                            <label>Review Comment</label>

                            <textarea name="review_comment" rows="4" required></textarea>

                            <button class="action-review" type="submit">
                                Submit Review Comment
                            </button>

                        </form>

                    </div>

                    <div id="reject-box" class="review-form" style="display:none;">

                        <form method="POST" action="{{ route('campaigns.reject', $campaign) }}">
                            @csrf

                            <label>Reject Reason</label>

                            <textarea name="review_comment" rows="4" required></textarea>

                            <button class="action-reject" type="submit">
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