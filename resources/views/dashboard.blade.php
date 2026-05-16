@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if($user->isDonor())
        <div class="page-header">
            <div>
                <p class="eyebrow">Donor Workspace</p>
                <h1>Welcome back, {{ $user->name }}</h1>
                <p class="muted">Manage your profile, submit donations, and track your own donation history.</p>
            </div>
            <div class="toolbar">
                <a href="{{ route('public-donations.create') }}" class="btn">Make Donation</a>
                <a href="{{ route('donations.index') }}" class="btn-secondary">View My Donations</a>
            </div>
        </div>

        <div class="cards">
            <div class="metric-card">
                <div class="metric-label">My Total Donations</div>
                <p class="metric-value">RM {{ number_format($donorSummary['total_amount'] ?? 0, 2) }}</p>
            </div>
            <div class="metric-card">
                <div class="metric-label">My Donation Records</div>
                <p class="metric-value">{{ $donorSummary['total_records'] ?? 0 }}</p>
            </div>
            <div class="metric-card">
                <div class="metric-label">Pending Verification</div>
                <p class="metric-value">{{ $donorSummary['pending_records'] ?? 0 }}</p>
            </div>
            <div class="metric-card">
                <div class="metric-label">Active Campaigns</div>
                <p class="metric-value">{{ $donorSummary['active_campaigns'] ?? 0 }}</p>
            </div>
        </div>

        <div class="page-header" style="margin-top: 26px;">
            <div>
                <h2>Recent Personal Donations</h2>
                <p class="muted">Only your own records are visible in the donor dashboard.</p>
            </div>
        </div>

        <div class="table-shell">
            <table>
                <thead>
                    <tr>
                        <th>Receipt</th>
                        <th>Purpose</th>
                        <th>Campaign</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(($donorSummary['recent_donations'] ?? collect()) as $donation)
                        <tr>
                            <td>{{ $donation->receipt_number ?? '-' }}</td>
                            <td>{{ $donation->purpose->name ?? 'General' }}</td>
                            <td>{{ $donation->campaign->title ?? '-' }}</td>
                            <td>RM {{ number_format($donation->amount, 2) }}</td>
                            <td>{{ $donation->donation_date?->format('Y-m-d') }}</td>
                            <td>
                                @php
                                    $statusClass = in_array($donation->status, $approvedDonationStatuses) ? 'approved' : (in_array($donation->status, $failedDonationStatuses) ? 'rejected' : 'pending');
                                @endphp
                                <span class="badge badge-{{ $statusClass }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No donation record found yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    @elseif($user->isStaff())
        <div class="page-header">
            <div>
                <p class="eyebrow">Staff Workspace</p>
                <h1>Operations Dashboard</h1>
                <p class="muted">Track your pending work, operational submissions, and donation verification queue.</p>
            </div>
            <div class="toolbar">
                <a href="{{ route('donations.index') }}" class="btn">Open Donations</a>
                <a href="{{ route('campaigns.index') }}" class="btn-secondary">View Campaigns</a>
            </div>
        </div>

        <div class="cards">
            <div class="metric-card">
                <div class="metric-label">My Draft Items</div>
                <p class="metric-value">{{ $myDrafts }}</p>
            </div>
            <div class="metric-card">
                <div class="metric-label">My Pending Items</div>
                <p class="metric-value">{{ $myPendingItems }}</p>
            </div>
            <div class="metric-card">
                <div class="metric-label">Pending Approvals</div>
                <p class="metric-value">{{ $pendingApprovals }}</p>
            </div>
            <div class="metric-card">
                <div class="metric-label">Active Campaigns</div>
                <p class="metric-value">{{ $totalCampaigns }}</p>
            </div>
        </div>

        <div class="page-header" style="margin-top: 28px;">
            <div>
                <h2>Approval Queue</h2>
                <p class="muted">Items waiting for review or action.</p>
            </div>
        </div>

        <div class="table-shell">
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approvalQueue as $item)
                        <tr>
                            <td>{{ $item['type'] }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>RM {{ number_format($item['amount'], 2) }}</td>
                            <td><span class="badge badge-pending">{{ ucfirst($item['status']) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No pending queue item found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    @else
        <div class="page-header">
            <div>
                <p class="eyebrow">Admin Workspace</p>
                <h1>NGO Fund Management Dashboard</h1>
                <p class="muted">Monitor governance, approvals, campaign activity, and full platform overview.</p>
            </div>
            <div class="toolbar">
                <a href="{{ route('donors.index') }}" class="btn-secondary">View Donors</a>
                <a href="{{ route('campaigns.index') }}" class="btn">Open Campaigns</a>
                <a href="{{ route('audit-logs.index') }}" class="btn-secondary">Audit Logs</a>
            </div>
        </div>

        <div class="cards">
            <div class="metric-card">
                <div class="metric-label">Total Donors</div>
                <p class="metric-value">{{ $totalDonors }}</p>
            </div>
            <div class="metric-card">
                <div class="metric-label">Verified Donations</div>
                <p class="metric-value">RM {{ number_format($totalDonations, 2) }}</p>
            </div>
            <div class="metric-card">
                <div class="metric-label">Pending Approvals</div>
                <p class="metric-value">{{ $pendingApprovals }}</p>
            </div>
            <div class="metric-card">
                <div class="metric-label">Active Campaigns</div>
                <p class="metric-value">{{ $totalCampaigns }}</p>
            </div>
        </div>

        <div class="page-header" style="margin-top: 28px;">
            <div>
                <h2>Recent Donations</h2>
                <p class="muted">Latest records across the platform.</p>
            </div>
        </div>

        <div class="table-shell">
            <table>
                <thead>
                    <tr>
                        <th>Donor</th>
                        <th>Purpose</th>
                        <th>Campaign</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentDonations as $donation)
                        <tr>
                            <td>{{ $donation->donor->full_name ?? '-' }}</td>
                            <td>{{ $donation->purpose->name ?? '-' }}</td>
                            <td>{{ $donation->campaign->title ?? '-' }}</td>
                            <td>RM {{ number_format($donation->amount, 2) }}</td>
                            <td>{{ $donation->donation_date?->format('Y-m-d') }}</td>
                            <td>
                                @php
                                    $statusClass = in_array($donation->status, $approvedDonationStatuses) ? 'approved' : (in_array($donation->status, $failedDonationStatuses) ? 'rejected' : 'pending');
                                @endphp
                                <span class="badge badge-{{ $statusClass }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No donations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
@endsection