@extends('layouts.app')

@section('title', 'Donation Ledger')
@section('page_title', 'Donation Ledger')

@section('content')

@php
    $totalAmount = $donations->sum('amount');
    $successfulDonations = $donations->where('status', 'completed')->count();
    $pendingDonations = $donations->where('status', 'pending')->count();

    $campaigns = $donations
        ->pluck('campaign')
        ->filter()
        ->unique('id')
        ->values();

    $methods = $donations
        ->pluck('payment_method')
        ->filter()
        ->unique()
        ->values();
@endphp

<style>
    .donation-hero {
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

    .donation-hero h1 {
        margin: 0 0 10px;
        color: white;
        font-size: 42px;
        letter-spacing: -1px;
    }

    .donation-hero p {
        margin: 0;
        color: #dcfce7;
        line-height: 1.7;
        max-width: 760px;
    }

    .donation-hero .eyebrow {
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

    .donation-kpi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .donation-kpi {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 28px;
        padding: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .donation-kpi span {
        color: #64748b;
        font-weight: 800;
        font-size: 14px;
    }

    .donation-kpi strong {
        display: block;
        color: #08783f;
        font-size: 38px;
        margin-top: 12px;
    }

    .donation-kpi p {
        margin: 8px 0 0;
        color: #64748b;
        line-height: 1.5;
    }

    .filter-panel {
        background: white;
        border: 1px solid #dbeee3;
        border-radius: 28px;
        padding: 22px;
        margin-bottom: 24px;
        box-shadow: 0 18px 45px rgba(15,23,42,.06);
    }

    .filter-head {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        align-items: center;
        margin-bottom: 18px;
    }

    .filter-head h3 {
        margin: 0;
        color: #0b1f16;
        font-size: 23px;
    }

    .filter-head p {
        margin: 5px 0 0;
        color: #64748b;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr 1fr 1fr;
        gap: 14px;
    }

    .filter-grid input,
    .filter-grid select {
        width: 100%;
        padding: 14px 16px;
        border-radius: 16px;
        border: 1px solid #cbd8d0;
        outline: none;
        font-size: 14px;
    }

    .filter-grid input:focus,
    .filter-grid select:focus {
        border-color: #08783f;
        box-shadow: 0 0 0 4px rgba(8,120,63,.08);
    }

    .ledger-panel {
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

    .premium-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 980px;
    }

    .premium-table th {
        text-align: left;
        color: #64748b;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .10em;
        padding: 14px 12px;
        border-bottom: 1px solid #e5eee8;
        background: #f8fcfa;
    }

    .premium-table td {
        padding: 18px 12px;
        border-bottom: 1px solid #eef5f0;
        color: #10231a;
        vertical-align: middle;
    }

    .campaign-cell strong {
        display: block;
        color: #0b1f16;
        margin-bottom: 5px;
    }

    .campaign-cell span {
        color: #64748b;
        font-size: 13px;
    }

    .amount-text {
        font-weight: 900;
        color: #08783f;
        font-size: 17px;
    }

    .method-pill {
        display: inline-flex;
        padding: 8px 12px;
        border-radius: 999px;
        background: #f4fbf7;
        color: #0b1f16;
        font-weight: 800;
        font-size: 13px;
        border: 1px solid #dbeee3;
    }

    .status-pill {
        display: inline-flex;
        padding: 8px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .status-completed {
        background: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-other {
        background: #e0f2fe;
        color: #075985;
    }

    .empty-premium {
        text-align: center;
        padding: 34px;
        color: #64748b;
    }

    .hide-row {
        display: none;
    }

    @media(max-width: 1050px) {
        .donation-kpi-grid {
            grid-template-columns: 1fr;
        }

        .filter-grid {
            grid-template-columns: 1fr 1fr;
        }

        .donation-hero {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media(max-width: 640px) {
        .filter-grid {
            grid-template-columns: 1fr;
        }

        .donation-hero h1 {
            font-size: 32px;
        }

        .ledger-head {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="donation-hero">
    <div>
        <p class="eyebrow">IMPACTRELIEF DONATION LEDGER</p>
        <h1>Donation Transaction Records</h1>
        <p>
            Monitor donation transactions, payment methods, campaign contributions
            and verification status across the ImpactRelief platform.
        </p>
    </div>

    @if(auth()->user()->isDonor())
        <a href="{{ route('public-donations.create') }}" class="hero-btn">
            Donate Again
        </a>
    @else
        <a href="{{ route('public-donations.catalog') }}" class="hero-btn">
            Public Donation Page
        </a>
    @endif
</div>

<div class="donation-kpi-grid">
    <div class="donation-kpi">
        <span>Total Transactions</span>
        <strong>{{ $donations->count() }}</strong>
        <p>Donation records captured in the system.</p>
    </div>

    <div class="donation-kpi">
        <span>Total Contributions</span>
        <strong>RM{{ number_format($totalAmount, 2) }}</strong>
        <p>Combined amount contributed by donors.</p>
    </div>

    <div class="donation-kpi">
        <span>Verified Payments</span>
        <strong>{{ $successfulDonations }}</strong>
        <p>Completed and verified donation transactions.</p>
    </div>
</div>

<div class="filter-panel">
    <div class="filter-head">
        <div>
            <h3>Filter Donation Records</h3>
            <p>Search by campaign, method, bank or transaction status.</p>
        </div>
    </div>

    <div class="filter-grid">
        <input type="text"
               id="searchInput"
               placeholder="Search campaign, bank or payment method...">

        <select id="campaignFilter">
            <option value="">All Campaigns</option>
            @foreach($campaigns as $campaign)
                <option value="{{ strtolower($campaign->title) }}">
                    {{ $campaign->title }}
                </option>
            @endforeach
        </select>

        <select id="methodFilter">
            <option value="">All Methods</option>
            @foreach($methods as $method)
                <option value="{{ strtolower($method) }}">
                    {{ $method }}
                </option>
            @endforeach
        </select>

        <select id="statusFilter">
            <option value="">All Status</option>
            <option value="completed">Completed</option>
            <option value="pending">Pending</option>
        </select>
    </div>
</div>

<div class="ledger-panel">
    <div class="ledger-head">
        <div>
            <h3>Donation Ledger</h3>
            <p>Detailed contribution records grouped by campaign, payment channel and verification status.</p>
        </div>

        <div class="ledger-count">
            {{ $donations->count() }} Records
        </div>
    </div>

    <table class="premium-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Campaign</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Bank / Gateway</th>
            <th>Status</th>
        </tr>
        </thead>

        <tbody>
        @forelse($donations as $donation)
            @php
                $campaignName = $donation->campaign->title ?? 'Campaign Deleted';
                $method = $donation->payment_method ?? '-';
                $bank = $donation->payment_gateway ?? '-';
                $status = $donation->status ?? 'pending';
            @endphp

            <tr class="donation-row"
                data-search="{{ strtolower($campaignName . ' ' . $method . ' ' . $bank . ' ' . $status) }}"
                data-campaign="{{ strtolower($campaignName) }}"
                data-method="{{ strtolower($method) }}"
                data-status="{{ strtolower($status) }}">

                <td>
                    {{ $donation->created_at ? $donation->created_at->format('d M Y') : '-' }}
                </td>

                <td class="campaign-cell">
                    <strong>{{ $campaignName }}</strong>
                    <span>Contribution record</span>
                </td>

                <td>
                    <span class="amount-text">
                        RM{{ number_format($donation->amount, 2) }}
                    </span>
                </td>

                <td>
                    <span class="method-pill">
                        {{ $method }}
                    </span>
                </td>

                <td>
                    {{ $bank }}
                </td>

                <td>
                    @if($status === 'completed')
                        <span class="status-pill status-completed">Completed</span>
                    @elseif($status === 'pending')
                        <span class="status-pill status-pending">Pending</span>
                    @else
                        <span class="status-pill status-other">
                            {{ ucfirst($status) }}
                        </span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="empty-premium">
                    No donation record found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const campaignFilter = document.getElementById('campaignFilter');
    const methodFilter = document.getElementById('methodFilter');
    const statusFilter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('.donation-row');

    function filterRows() {
        const search = searchInput.value.toLowerCase();
        const campaign = campaignFilter.value.toLowerCase();
        const method = methodFilter.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();

        rows.forEach(row => {
            const rowSearch = row.dataset.search || '';
            const rowCampaign = row.dataset.campaign || '';
            const rowMethod = row.dataset.method || '';
            const rowStatus = row.dataset.status || '';

            const matchSearch = rowSearch.includes(search);
            const matchCampaign = !campaign || rowCampaign === campaign;
            const matchMethod = !method || rowMethod === method;
            const matchStatus = !status || rowStatus === status;

            row.classList.toggle(
                'hide-row',
                !(matchSearch && matchCampaign && matchMethod && matchStatus)
            );
        });
    }

    searchInput.addEventListener('input', filterRows);
    campaignFilter.addEventListener('change', filterRows);
    methodFilter.addEventListener('change', filterRows);
    statusFilter.addEventListener('change', filterRows);
</script>

@endsection