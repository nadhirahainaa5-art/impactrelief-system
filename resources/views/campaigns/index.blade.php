@extends('layouts.app')

@section('title', 'Campaign Portfolio')
@section('page_title', 'Campaign Portfolio')

@section('content')

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
        max-width: 780px;
    }

    .campaign-hero .eyebrow {
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

    .campaign-kpi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 26px;
    }

    .campaign-kpi {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 28px;
        padding: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .campaign-kpi span {
        color: #64748b;
        font-weight: 800;
        font-size: 14px;
    }

    .campaign-kpi strong {
        display: block;
        color: #08783f;
        font-size: 40px;
        margin-top: 14px;
    }

    .campaign-kpi p {
        margin: 8px 0 0;
        color: #64748b;
        line-height: 1.5;
    }

    .portfolio-head {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 18px;
        margin: 32px 0 18px;
    }

    .portfolio-head h2 {
        margin: 0 0 6px;
        font-size: 30px;
        color: #0b1f16;
    }

    .portfolio-head p {
        margin: 0;
        color: #64748b;
    }

    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }

    .portfolio-card {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
        transition: .2s ease;
    }

    .portfolio-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 24px 60px rgba(15,23,42,.10);
    }

    .portfolio-cover {
        height: 160px;
        background:
            linear-gradient(rgba(6,59,35,.35), rgba(6,59,35,.35)),
            linear-gradient(135deg, #08783f, #22c55e);
        display: flex;
        align-items: flex-end;
        padding: 20px;
        color: white;
    }

    .portfolio-cover small {
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
        background: rgba(255,255,255,.18);
        padding: 8px 12px;
        border-radius: 999px;
        backdrop-filter: blur(8px);
    }

    .portfolio-body {
        padding: 24px;
    }

    .portfolio-top {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .portfolio-title {
        margin: 0;
        font-size: 22px;
        color: #0b1f16;
        line-height: 1.25;
    }

    .status-pill {
        display: inline-flex;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .status-approved { background: #dcfce7; color: #166534; }
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-review { background: #e0f2fe; color: #075985; }
    .status-rejected { background: #fee2e2; color: #991b1b; }

    .portfolio-desc {
        color: #64748b;
        line-height: 1.7;
        min-height: 78px;
        margin: 0 0 18px;
    }

    .fund-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .fund-row span {
        color: #64748b;
    }

    .fund-row strong {
        color: #0b1f16;
    }

    .progress-bar {
        height: 10px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
        margin: 14px 0;
    }

    .progress-bar div {
        height: 100%;
        background: linear-gradient(90deg, #08783f, #22c55e);
        border-radius: 999px;
    }

    .campaign-meta-box {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 16px;
    }

    .mini-info {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 16px;
        padding: 12px;
    }

    .mini-info span {
        display: block;
        color: #64748b;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .mini-info strong {
        color: #08783f;
        font-size: 14px;
    }

    .review-box {
        margin-top: 16px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        border-radius: 18px;
        padding: 14px;
        line-height: 1.6;
        font-size: 14px;
    }

    .portfolio-footer {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
    }

    .date-text {
        color: #64748b;
        font-weight: 800;
        font-size: 13px;
    }

    .details-btn {
        background: #08783f;
        color: white;
        padding: 11px 16px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 900;
        white-space: nowrap;
    }

    .empty-premium {
        grid-column: 1 / -1;
        text-align: center;
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 44px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    @media(max-width: 1050px) {
        .portfolio-grid,
        .campaign-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .campaign-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media(max-width: 680px) {
        .portfolio-grid,
        .campaign-kpi-grid,
        .campaign-meta-box {
            grid-template-columns: 1fr;
        }

        .campaign-hero h1 {
            font-size: 32px;
        }

        .portfolio-head {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="campaign-hero">
    <div>
        <p class="eyebrow">IMPACTRELIEF CAMPAIGN PORTFOLIO</p>
        <h1>Relief Campaign Management</h1>
        <p>
            Monitor campaign readiness, fundraising progress, approval status and beneficiary
            targets across the ImpactRelief humanitarian operations platform.
        </p>
    </div>

    @if(auth()->user()->isStaff())
        <a href="{{ route('campaigns.create') }}" class="hero-btn">
            + Create Campaign
        </a>
    @endif
</div>

<div class="campaign-kpi-grid">
    <div class="campaign-kpi">
        <span>Campaign Portfolio</span>
        <strong>{{ $campaigns->count() }}</strong>
        <p>Total campaigns available in this workspace.</p>
    </div>

    <div class="campaign-kpi">
        <span>Donation-Ready Campaigns</span>
        <strong>{{ $campaigns->where('status', 'approved')->count() }}</strong>
        <p>Approved campaigns available for public support.</p>
    </div>

    <div class="campaign-kpi">
        <span>Admin Review Queue</span>
        <strong>{{ $campaigns->where('status', 'pending')->count() + $campaigns->where('status', 'under_review')->count() }}</strong>
        <p>Campaigns waiting for approval or staff revision.</p>
    </div>
</div>

<div class="portfolio-head">
    <div>
        <h2>Campaign Portfolio</h2>
        <p>Each campaign card shows status, funding progress and operational readiness.</p>
    </div>
</div>

<div class="portfolio-grid">
    @forelse($campaigns as $campaign)
        @php
            $raised = $campaign->amount_raised ?? 0;
            $goal = $campaign->funding_goal ?? 0;
            $percent = $goal > 0 ? min(($raised / $goal) * 100, 100) : 0;
            $needed = max($goal - $raised, 0);
        @endphp

        <div class="portfolio-card">
            @if($campaign->poster_path)

    <div class="portfolio-cover"
         style="
            background:
            linear-gradient(rgba(5,46,27,.35), rgba(5,46,27,.35)),
            url('{{ asset('storage/' . $campaign->poster_path) }}');
            background-size: cover;
            background-position: center;
         ">
        <small>Humanitarian Campaign</small>
    </div>

@else

    <div class="portfolio-cover">
        <small>Humanitarian Campaign</small>
    </div>

@endif

            <div class="portfolio-body">
                <div class="portfolio-top">
                    <h3 class="portfolio-title">{{ $campaign->title }}</h3>

                    @if($campaign->status == 'approved')
                        <span class="status-pill status-approved">Approved</span>
                    @elseif($campaign->status == 'pending')
                        <span class="status-pill status-pending">Pending</span>
                    @elseif($campaign->status == 'under_review')
                        <span class="status-pill status-review">Under Review</span>
                    @else
                        <span class="status-pill status-rejected">Rejected</span>
                    @endif
                </div>

                <p class="portfolio-desc">
                    {{ \Illuminate\Support\Str::limit($campaign->description ?? 'No description provided.', 105) }}
                </p>

                <div class="fund-row">
                    <span>Raised</span>
                    <strong>RM{{ number_format($raised, 2) }}</strong>
                </div>

                <div class="fund-row">
                    <span>Target</span>
                    <strong>RM{{ number_format($goal, 2) }}</strong>
                </div>

                <div class="progress-bar">
                    <div style="width: {{ $percent }}%;"></div>
                </div>

                <div class="fund-row">
                    <span>Funding Progress</span>
                    <strong>{{ number_format($percent, 0) }}%</strong>
                </div>

                <div class="campaign-meta-box">
                    <div class="mini-info">
                        <span>Still Needed</span>
                        <strong>RM{{ number_format($needed, 2) }}</strong>
                    </div>

                    <div class="mini-info">
                        <span>Beneficiaries</span>
                        <strong>{{ $campaign->target_beneficiaries ?? '-' }}</strong>
                    </div>
                </div>

                @if($campaign->review_comment)
                    <div class="review-box">
                        <strong>Admin Review Note:</strong><br>
                        {{ $campaign->review_comment }}
                    </div>
                @endif

                <div class="portfolio-footer">
                    <span class="date-text">
                        {{ $campaign->start_date ? $campaign->start_date->format('d M Y') : 'No Date' }}
                    </span>

                    <a href="{{ route('campaigns.show', $campaign) }}" class="details-btn">
                        Details →
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="empty-premium">
            <h2>No Campaign Found</h2>
            <p class="muted">No campaign available right now.</p>

            @if(auth()->user()->isStaff())
                <a href="{{ route('campaigns.create') }}" class="details-btn">
                    Create First Campaign
                </a>
            @endif
        </div>
    @endforelse
</div>

@endsection