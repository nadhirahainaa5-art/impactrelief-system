@extends('layouts.app')

@section('title', 'Donor Dashboard')
@section('page_title', 'Donor Dashboard')

@section('content')

<div class="page-header">
    <div>
        <p class="eyebrow">Giving Center</p>
        <h1>Support Meaningful Campaigns</h1>
        <p class="muted">
            Choose approved campaigns and donate securely with full transparency.
        </p>
    </div>

    <div class="toolbar">
        <a href="{{ route('public-donations.create') }}" class="btn">
            Donate Now
        </a>
    </div>
</div>

<div class="cards">

    <div class="metric-card">
        <div class="metric-label">Total Donated</div>
        <h3 class="metric-value">RM{{ number_format($totalDonated, 2) }}</h3>
        <div class="metric-note">Your lifetime contribution</div>
    </div>

    <div class="metric-card">
        <div class="metric-label">My Donations</div>
        <h3 class="metric-value">{{ $totalMyDonations }}</h3>
        <div class="metric-note">Transactions completed</div>
    </div>

    <div class="metric-card">
        <div class="metric-label">Supported Campaigns</div>
        <h3 class="metric-value">{{ $supportedCampaigns }}</h3>
        <div class="metric-note">Different campaigns helped</div>
    </div>

    <div class="metric-card">
        <div class="metric-label">Open Campaigns</div>
        <h3 class="metric-value">{{ $campaigns->count() }}</h3>
        <div class="metric-note">Ready for donation</div>
    </div>

</div>

<div class="page-header section-gap" style="margin-bottom:16px;">
    <div>
        <h2 style="margin:0;">Featured Campaigns</h2>
        <p class="muted">Donate directly to verified causes.</p>
    </div>
</div>

<div class="campaign-grid">

    @forelse($campaigns as $campaign)

        @php
            $raised = $campaign->amount_raised ?? 0;
            $goal = $campaign->funding_goal ?? 0;
            $percent = $goal > 0 ? min(($raised / $goal) * 100, 100) : 0;
            $needed = max($goal - $raised, 0);
        @endphp

        <div class="campaign-card">

            <div class="campaign-image gradient-{{ ($loop->iteration % 6) + 1 }}">
                💚
            </div>

            <div class="campaign-body">

                <div class="campaign-meta">
                    <span>Approved Campaign</span>
                    <small>{{ number_format($percent, 0) }}%</small>
                </div>

                <h3>{{ $campaign->title }}</h3>

                <p class="campaign-desc">
                    {{ \Illuminate\Support\Str::limit($campaign->description ?? 'No description.', 90) }}
                </p>

                <div class="campaign-info">
                    <p>🎯 Goal: RM{{ number_format($goal, 2) }}</p>
                    <p>💚 Raised: RM{{ number_format($raised, 2) }}</p>
                    <p>📉 Needed: RM{{ number_format($needed, 2) }}</p>
                </div>

                <div class="progress-wrap">
                    <div class="progress-label">
                        <span>Progress</span>
                        <span>{{ number_format($percent, 0) }}%</span>
                    </div>

                    <div class="progress-track">
                        <div class="progress-fill"
                             style="width: {{ $percent }}%;">
                        </div>
                    </div>
                </div>

                <div class="campaign-footer" style="margin-top:14px;">
                    <strong>
                        {{ $campaign->target_beneficiaries ?? '-' }} People
                    </strong>

                    <a href="{{ route('public-donations.create') }}?campaign={{ $campaign->id }}"
                       class="details-btn">
                        Donate →
                    </a>
                </div>

            </div>

        </div>

    @empty

        <div class="content-card" style="grid-column:1/-1; text-align:center;">
            <h2 style="margin-top:0;">No Active Campaign</h2>
            <p class="muted">
                No approved campaign available right now.
            </p>
        </div>

    @endforelse

</div>

@endsection