@extends('layouts.app')

@section('title', 'Staff Operations Centre')
@section('page_title', 'Staff Operations Centre')

@section('content')

<style>
    .campaign-progress-card{
    background:#f8fcfa;
    border:1px solid #e3f1e8;
    border-radius:22px;
    padding:20px;
    margin-top:0;
}

.campaign-progress-top{
    display:flex;
    justify-content:space-between;
    gap:20px;
    margin-bottom:14px;
}

.campaign-progress-title{
    font-size:18px;
    font-weight:800;
    color:#0b1f16;
    margin-bottom:6px;
}

.campaign-progress-meta{
    color:#64748b;
    font-size:14px;
}

.campaign-progress-percent{
    font-size:22px;
    font-weight:900;
    color:#08783f;
}

.progress-track{
    height:10px;
    background:#e5e7eb;
    border-radius:999px;
    overflow:hidden;
}

.progress-fill{
    height:100%;
    border-radius:999px;
    background:linear-gradient(
        90deg,
        #08783f,
        #22c55e
    );
}
    .staff-hero {
        background: linear-gradient(135deg, #063b23, #0f9f55);
        border-radius: 34px;
        padding: 34px;
        color: white;
        display: flex;
        justify-content: space-between;
        gap: 24px;
        align-items: center;
        box-shadow: 0 24px 55px rgba(6, 59, 35, .20);
        margin-bottom: 28px;
    }

    .staff-hero .eyebrow {
        color: #bbf7d0;
        letter-spacing: .14em;
        font-weight: 900;
        margin: 0 0 12px;
    }

    .staff-hero h1 {
        font-size: 42px;
        margin: 0 0 12px;
        color: white;
        letter-spacing: -1px;
    }

    .staff-hero p {
        margin: 0;
        max-width: 760px;
        line-height: 1.7;
        color: #ecfdf5;
        font-size: 16px;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .hero-btn {
        background: #ffffff;
        color: #08783f;
        padding: 15px 22px;
        border-radius: 999px;
        font-weight: 900;
        text-decoration: none;
        white-space: nowrap;
    }

    .hero-btn-outline {
        border: 1px solid rgba(255,255,255,.45);
        color: white;
        padding: 15px 22px;
        border-radius: 999px;
        font-weight: 900;
        text-decoration: none;
        white-space: nowrap;
    }

    .metric-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 26px;
}

.three-kpi{
    grid-template-columns:repeat(3,1fr);
}

.main-kpi{
    min-height:180px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.main-kpi .metric-label{
    font-size:15px;
    font-weight:700;
    color:#64748b;
    margin-bottom:14px;
}

.main-kpi .metric-value{
    font-size:46px;
    font-weight:900;
    color:#0b7a43;
    line-height:1;
    margin-bottom:16px;
}

.main-kpi .metric-note{
    color:#64748b;
    font-size:15px;
    line-height:1.6;
}

@media(max-width:1000px){

    .three-kpi{
        grid-template-columns:1fr;
    }

}

    .premium-card {
        background: rgba(255,255,255,.92);
        border: 1px solid #dbeee3;
        border-radius: 28px;
        padding: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
        position: relative;
        overflow: hidden;
    }

    .premium-card::after {
        content: "";
        position: absolute;
        right: -35px;
        top: -35px;
        width: 90px;
        height: 90px;
        background: #e7fff1;
        border-radius: 50%;
    }

    .metric-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        position: relative;
        z-index: 2;
    }

    .metric-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        background: #e8fbef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }

    .metric-label {
        color: #64748b;
        font-weight: 800;
        font-size: 14px;
        position: relative;
        z-index: 2;
    }

    .metric-value {
        font-size: 38px;
        margin: 0;
        color: #08783f;
        position: relative;
        z-index: 2;
    }

    .metric-note {
        color: #64748b;
        font-size: 14px;
        margin-top: 6px;
        position: relative;
        z-index: 2;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.15fr .85fr;
        gap: 22px;
        margin-bottom: 24px;
    }
    
    .chart-wrapper{
    position: relative;
    width: 380px;
    height: 380px;

    margin: 20px auto;

    display: flex;
    align-items: center;
    justify-content: center;
}

.panel{
    background: white;
    border: 1px solid #dbeee3;
    border-radius: 30px;
    padding: 26px;
    box-shadow: 0 18px 45px rgba(15,23,42,.06);

    align-self: start;
}

    .panel h3 {
        margin: 0 0 6px;
        color: #0b1f16;
        font-size: 24px;
    }

    .panel-sub {
        margin: 0 0 22px;
        color: #64748b;
        line-height: 1.6;
    }

    .finance-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .finance-card {
        background: #f4fbf7;
        border: 1px solid #dcefe4;
        border-radius: 22px;
        padding: 18px;
    }

    .finance-card span {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .finance-card strong {
        color: #08783f;
        font-size: 21px;
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .activity-item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 15px;
        border-radius: 20px;
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
    }

    .activity-dot {
        width: 38px;
        height: 38px;
        border-radius: 14px;
        background: #e8fbef;
        color: #08783f;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .activity-item strong {
        display: block;
        color: #0b1f16;
        margin-bottom: 4px;
    }

    .activity-item span {
        color: #64748b;
        font-size: 14px;
    }

    .campaign-table {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
        overflow-x: auto;
    }

    .table-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .table-head h3 {
        margin: 0;
        font-size: 24px;
        color: #0b1f16;
    }

    .table-head p {
        margin: 6px 0 0;
        color: #64748b;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 720px;
    }

    th {
        text-align: left;
        color: #64748b;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .08em;
        padding: 14px 12px;
        border-bottom: 1px solid #e5eee8;
    }

    td {
        padding: 16px 12px;
        border-bottom: 1px solid #eef5f0;
        color: #10231a;
        font-weight: 600;
    }

    .progress-bg {
        height: 9px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
        margin-top: 8px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #08783f, #22c55e);
        border-radius: 999px;
    }

    .badge-soft {
        display: inline-flex;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
    }

    .badge-approved { background: #dcfce7; color: #166534; }
    .badge-pending { background: #fef3c7; color: #92400e; }
    .badge-review { background: #e0f2fe; color: #075985; }
    .badge-rejected { background: #fee2e2; color: #991b1b; }

    .details-btn {
        display: inline-flex;
        padding: 10px 15px;
        border-radius: 999px;
        background: #08783f;
        color: white;
        text-decoration: none;
        font-weight: 900;
    }

    .empty-state {
        text-align: center;
        color: #64748b;
        padding: 30px;
    }

    @media(max-width: 980px) {
        .staff-hero,
        .dashboard-grid {
            grid-template-columns: 1fr;
            flex-direction: column;
            align-items: flex-start;
        }

        .metric-grid,
        .finance-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 620px) {
        .metric-grid,
        .finance-grid {
            grid-template-columns: 1fr;
        }

        .staff-hero h1 {
            font-size: 32px;
        }
    }
</style>

<div class="staff-hero">
    <div>
        <p class="eyebrow">IMPACTRELIEF STAFF WORKSPACE</p>
        <h1>Relief Operations Dashboard</h1>
        <p>
            Monitor campaign performance, submit funding requests, track expenses and
            respond to administrator reviews from one professional operations centre.
        </p>
    </div>

    <div class="hero-actions">
        <a href="{{ route('campaigns.create') }}" class="hero-btn">
            + Create Campaign
        </a>

        <a href="{{ route('campaigns.index') }}" class="hero-btn-outline">
            View Campaigns
        </a>
    </div>
</div>

<div class="metric-grid three-kpi">

    <div class="premium-card main-kpi">
        <div class="metric-label">Active Campaigns</div>
        <h3 class="metric-value">{{ $totalCampaigns }}</h3>
        <div class="metric-note">Campaigns currently managed by staff</div>
    </div>

    <div class="premium-card main-kpi">
        <div class="metric-label">Total Donations Raised</div>
        <h3 class="metric-value">RM{{ number_format($totalRaised, 2) }}</h3>
        <div class="metric-note">Across approved and active campaigns</div>
    </div>

    <div class="premium-card main-kpi">
        <div class="metric-label">Pending Admin Actions</div>
        <h3 class="metric-value">{{ $pendingCampaigns + $reviewCampaigns }}</h3>
        <div class="metric-note">Waiting approval or requiring revision</div>
    </div>

</div>

<div class="finance-grid">
    <div class="finance-card">
        <span>Total Funding Goal</span>
        <strong>RM{{ number_format($totalGoal, 2) }}</strong>
    </div>

    <div class="finance-card">
        <span>Total Amount Raised</span>
        <strong>RM{{ number_format($totalRaised, 2) }}</strong>
    </div>

    <div class="finance-card">
        <span>Remaining Target</span>
        <strong>RM{{ number_format($remaining, 2) }}</strong>
    </div>
</div>

<div class="panel" style="margin-bottom:24px;">

    <h3>Active Campaign Performance</h3>

    <p class="panel-sub">
        Live fundraising progress across your active humanitarian campaigns.
    </p>

    @foreach($recentCampaigns as $campaign)

        @php
            $goal = $campaign->funding_goal ?? 0;
            $raised = $campaign->amount_raised ?? 0;

            $percentage = $goal > 0
                ? min(100, round(($raised / $goal) * 100))
                : 0;
        @endphp

        <div style="
            margin-bottom:18px;
            padding:18px;
            border-radius:20px;
            background:#f8fcfa;
            border:1px solid #e3f1e8;
        ">

            <div style="
                display:flex;
                justify-content:space-between;
                margin-bottom:10px;
                gap:15px;
            ">

                <div>
                    <strong style="
                        display:block;
                        font-size:17px;
                        color:#0b1f16;
                    ">
                        {{ $campaign->title }}
                    </strong>

                    <span style="
                        color:#64748b;
                        font-size:14px;
                    ">
                        RM{{ number_format($raised,2) }}
                        raised from
                        RM{{ number_format($goal,2) }}
                    </span>
                </div>

                <div style="
                    font-weight:900;
                    color:#08783f;
                    font-size:18px;
                ">
                    {{ $percentage }}%
                </div>

            </div>

            <div style="
                height:10px;
                border-radius:999px;
                background:#e5e7eb;
                overflow:hidden;
            ">

                <div style="
                    width:{{ $percentage }}%;
                    height:100%;
                    border-radius:999px;
                    background:linear-gradient(
                        90deg,
                        #08783f,
                        #22c55e
                    );
                "></div>

            </div>

        </div>

    @endforeach

</div>

<div class="dashboard-grid">
    <div class="panel">
        <h3>Campaign Status Distribution</h3>
        <p class="panel-sub">Breakdown of campaign approval status.</p>
        <div class="chart-wrapper">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <div class="panel">
        <h3>Staff Action Guide</h3>
        <p class="panel-sub">Recommended next actions for maintaining transparent operations.</p>

        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-dot">1</div>
                <div>
                    <strong>Create relief campaign</strong>
                    <span>Submit campaign details, goal, date range and beneficiaries.</span>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-dot">2</div>
                <div>
                    <strong>Wait for admin approval</strong>
                    <span>Campaigns must be approved before public donations are accepted.</span>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-dot">3</div>
                <div>
                    <strong>Manage allocation and expenses</strong>
                    <span>Record fund usage clearly for transparency and reporting.</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="campaign-table">
    <div class="table-head">
        <div>
            <h3>Recent Campaign Submissions</h3>
            <p>Track approval status, funding goal and progress for your latest campaigns.</p>
        </div>

        <a href="{{ route('campaigns.index') }}" class="details-btn">
            View All
        </a>
    </div>

    <table>
        <thead>
        <tr>
            <th>Campaign</th>
            <th>Status</th>
            <th>Funding Goal</th>
            <th>Progress</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @forelse($recentCampaigns as $campaign)
            @php
                $goal = $campaign->funding_goal ?? 0;
                $raised = $campaign->amount_raised ?? 0;
                $percentage = $goal > 0 ? min(100, round(($raised / $goal) * 100)) : 0;
            @endphp

            <tr>
                <td>
                    <strong>{{ $campaign->title }}</strong>
                    <div style="color:#64748b; font-size:13px; margin-top:4px;">
                        RM{{ number_format($raised, 2) }} raised
                    </div>
                </td>

                <td>
                    @if($campaign->status == 'approved')
                        <span class="badge-soft badge-approved">Approved</span>
                    @elseif($campaign->status == 'pending')
                        <span class="badge-soft badge-pending">Pending</span>
                    @elseif($campaign->status == 'under_review')
                        <span class="badge-soft badge-review">Under Review</span>
                    @else
                        <span class="badge-soft badge-rejected">Rejected</span>
                    @endif
                </td>

                <td>RM{{ number_format($goal, 2) }}</td>

                <td>
                    <strong>{{ $percentage }}%</strong>
                    <div class="progress-bg">
                        <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                    </div>
                </td>

                <td>
                    <a href="{{ route('campaigns.show', $campaign) }}" class="details-btn">
                        Open
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="empty-state">
                    No campaign created yet.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<script>
const statusChart = new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Approved', 'Pending', 'Under Review', 'Rejected'],
        datasets: [{
            data: [
                {{ $approvedCampaigns }},
                {{ $pendingCampaigns }},
                {{ $reviewCampaigns }},
                {{ $rejectedCampaigns }}
            ],
            backgroundColor: ['#16a34a', '#f59e0b', '#0284c7', '#dc2626'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '68%',
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});


</script>

@endsection