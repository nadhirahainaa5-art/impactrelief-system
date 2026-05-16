@extends('layouts.app')

@section('title', 'Admin Command Centre')
@section('page_title', 'Admin Command Centre')

@section('content')

<style>
    .admin-hero {
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

    .admin-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 42px;
        letter-spacing: -1px;
    }

    .admin-hero p {
        margin: 0;
        color: #dcfce7;
        line-height: 1.7;
        max-width: 820px;
    }

    .admin-hero .eyebrow {
        color: #bbf7d0;
        letter-spacing: .14em;
        font-weight: 900;
        margin-bottom: 10px;
    }

    .admin-badge {
        background: rgba(255,255,255,.14);
        border: 1px solid rgba(255,255,255,.22);
        border-radius: 999px;
        padding: 13px 18px;
        font-weight: 900;
        white-space: nowrap;
    }

    .admin-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 26px;
    }

    .admin-kpi {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 28px;
        padding: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .admin-kpi span {
        color: #64748b;
        font-weight: 800;
        font-size: 14px;
    }

    .admin-kpi strong {
        display: block;
        color: #08783f;
        font-size: 34px;
        margin-top: 12px;
    }

    .admin-kpi p {
        margin: 8px 0 0;
        color: #64748b;
        line-height: 1.5;
    }

    .admin-grid {
        display: grid;
        grid-template-columns: 1.15fr .85fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    .admin-panel {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 30px;
        padding: 26px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .admin-panel h3 {
        margin: 0 0 6px;
        color: #0b1f16;
        font-size: 24px;
    }

    .panel-sub {
        margin: 0 0 20px;
        color: #64748b;
        line-height: 1.6;
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

    .finance-stack {
        display: grid;
        gap: 14px;
    }

    .finance-row {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 20px;
        padding: 18px;
        display: flex;
        justify-content: space-between;
        gap: 18px;
        align-items: center;
    }

    .finance-row span {
        color: #64748b;
        font-size: 14px;
        font-weight: 800;
    }

    .finance-row strong {
        color: #08783f;
        font-size: 22px;
        white-space: nowrap;
    }

    .review-queue {
        display: grid;
        gap: 14px;
    }

    .queue-item {
        background: #f8fcfa;
        border: 1px solid #e3f1e8;
        border-radius: 20px;
        padding: 18px;
        display: flex;
        justify-content: space-between;
        gap: 18px;
        align-items: center;
    }

    .queue-item strong {
        display: block;
        color: #0b1f16;
        margin-bottom: 5px;
    }

    .queue-item span {
        color: #64748b;
        font-size: 14px;
    }

    .queue-count {
        background: #e8fbef;
        color: #08783f;
        width: 46px;
        height: 46px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 20px;
        flex-shrink: 0;
    }

    .campaign-ledger {
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
        min-width: 850px;
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

    .campaign-main strong {
        display: block;
        color: #0b1f16;
        margin-bottom: 5px;
    }

    .campaign-main span {
        color: #64748b;
        font-size: 13px;
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

    @media(max-width: 1100px) {
        .admin-grid {
            grid-template-columns: 1fr;
        }

        .admin-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .admin-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media(max-width: 680px) {
        .admin-kpi-grid {
            grid-template-columns: 1fr;
        }

        .admin-hero h1 {
            font-size: 32px;
        }

        .ledger-head {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="admin-hero">
    <div>
        <p class="eyebrow">IMPACTRELIEF ADMIN COMMAND CENTRE</p>
        <h1>Governance & Financial Oversight</h1>
        <p>
            Monitor donations, campaign approvals, budget allocations and expense claims
            through one transparent humanitarian operations dashboard.
        </p>
    </div>

    <div class="admin-badge">
        ADMIN CONTROL PANEL
    </div>
</div>

<div class="admin-kpi-grid">
    <div class="admin-kpi">
        <span>Total Donations</span>
        <strong>RM{{ number_format($totalDonations, 2) }}</strong>
        <p>Public contributions received across campaigns.</p>
    </div>

    <div class="admin-kpi">
        <span>Campaign Portfolio</span>
        <strong>{{ $totalCampaigns }}</strong>
        <p>Total relief campaigns submitted into the system.</p>
    </div>

    <div class="admin-kpi">
        <span>Campaigns Awaiting Review</span>
        <strong>{{ $pendingCampaigns }}</strong>
        <p>Campaigns pending administrator decision.</p>
    </div>

    <div class="admin-kpi">
        <span>Returned for Revision</span>
        <strong>{{ $reviewCampaigns }}</strong>
        <p>Campaigns requiring staff clarification or updates.</p>
    </div>
</div>

<div class="admin-grid">
    <div class="admin-panel">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; margin-bottom:8px;">

    <h3 style="margin:0;">
        Financial Governance Summary
    </h3>

    <form method="GET" id="campaignFilterForm">

        <select name="campaign"
                style="
                    padding:10px 14px;
                    border-radius:14px;
                    border:1px solid #dbeee3;
                    background:white;
                    font-weight:700;
                    color:#0b1f16;
                ">

            <option value="all">
                All Campaigns
            </option>

            @foreach($campaigns as $campaign)
                <option value="{{ $campaign->id }}"
                    {{ $selectedCampaign == $campaign->id ? 'selected' : '' }}>
                    {{ $campaign->title }}
                </option>
            @endforeach

        </select>

    </form>

</div>

        <p class="panel-sub">
            Tracks donation inflow, approved budget allocation and verified expense usage.
        </p>

        <div class="finance-stack">
            <div class="finance-row">
                <span>Total Donation Inflow</span>
                <strong>RM{{ number_format($totalDonations, 2) }}</strong>
            </div>

            <div class="finance-row">
                <span>Approved / Allocated Budget</span>
                <strong>RM{{ number_format($totalAllocations, 2) }}</strong>
            </div>

            <div class="finance-row">
                <span>Approved Expense Usage</span>
                <strong>RM{{ number_format($totalExpenses, 2) }}</strong>
            </div>

            <div class="finance-row">
                <span>Unutilised Donation Balance</span>
                <strong>RM{{ number_format($totalDonations - $totalExpenses, 2) }}</strong>
            </div>
        </div>
    </div>

    <div class="admin-panel">
        <h3>Review Queue</h3>
        <p class="panel-sub">
            Key items requiring governance review and administrative action.
        </p>

        <div class="review-queue">
            <div class="queue-item">
                <div>
                    <strong>Pending Campaigns</strong>
                    <span>Campaign submissions awaiting approval.</span>
                </div>
                <div class="queue-count">{{ $pendingCampaigns }}</div>
            </div>

            <div class="queue-item">
                <div>
                    <strong>Under Review Campaigns</strong>
                    <span>Items returned to staff for revision.</span>
                </div>
                <div class="queue-count">{{ $reviewCampaigns }}</div>
            </div>

            <div class="queue-item">
                <div>
                    <strong>Registered Staff</strong>
                    <span>Operational users managing campaigns.</span>
                </div>
                <div class="queue-count">{{ $staff }}</div>
            </div>

            <div class="queue-item">
                <div>
                    <strong>Registered Donors</strong>
                    <span>Donor profiles recorded in the system.</span>
                </div>
                <div class="queue-count">{{ $donors }}</div>
            </div>
        </div>
    </div>
</div>

<div class="admin-grid">
    <div class="admin-panel">
        <h3>Campaign Approval Distribution</h3>
        <p class="panel-sub">Breakdown of campaign governance status.</p>
        <div class="chart-wrapper">
    <canvas id="campaignChart"></canvas>
</div>
    </div>

    <div class="admin-panel">
        <h3>Fund Governance Overview</h3>
        <p class="panel-sub">Compares donations received, budget allocation and approved expenses.</p>
        <canvas id="moneyChart"></canvas>
    </div>
</div>

<div class="campaign-ledger">
    <div class="ledger-head">
        <div>
            <h3>Latest Campaign Submissions</h3>
            <p>Review campaign status, funding goal and approval readiness.</p>
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th>Campaign</th>
            <th>Status</th>
            <th>Funding Goal</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @forelse($latestCampaigns as $campaign)
            <tr>
                <td class="campaign-main">
                    <strong>{{ $campaign->title }}</strong>
                    <span>{{ $campaign->created_at ? $campaign->created_at->format('d M Y') : '-' }}</span>
                </td>

                <td>
                    @if($campaign->status == 'approved')
                        <span class="status-pill status-approved">Approved</span>
                    @elseif($campaign->status == 'pending')
                        <span class="status-pill status-pending">Pending</span>
                    @elseif($campaign->status == 'under_review')
                        <span class="status-pill status-review">Under Review</span>
                    @else
                        <span class="status-pill status-rejected">Rejected</span>
                    @endif
                </td>

                <td>RM{{ number_format($campaign->funding_goal, 2) }}</td>

                <td>
                    <a href="{{ route('campaigns.show', $campaign) }}"
                       class="details-btn">
                        {{ in_array($campaign->status, ['pending', 'under_review']) ? 'Review' : 'View' }}
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="empty-state">
                    No campaigns found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<script>
const campaignChart = new Chart(document.getElementById('campaignChart'), {
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

const moneyChart = new Chart(document.getElementById('moneyChart'), {
    type: 'bar',
    data: {
        labels: ['Donations', 'Allocated Budget', 'Approved Expenses'],
        datasets: [{
            data: [
                {{ $totalDonations }},
                {{ $totalAllocations }},
                {{ $totalExpenses }}
            ],
            backgroundColor: ['#08783f', '#22c55e', '#f59e0b'],
            borderRadius: 14
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#eef5f0'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const filterForm = document.getElementById('campaignFilterForm');

    const campaignSelect = filterForm.querySelector('select[name="campaign"]');

    const savedPosition = sessionStorage.getItem('adminScrollPosition');

    if (savedPosition !== null) {

        setTimeout(() => {

            window.scrollTo(0, parseInt(savedPosition));

            sessionStorage.removeItem('adminScrollPosition');

        }, 50);

    }

    campaignSelect.addEventListener('change', function () {

        sessionStorage.setItem(
            'adminScrollPosition',
            window.scrollY
        );

        filterForm.submit();

    });

});

</script>

@endsection