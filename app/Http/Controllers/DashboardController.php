<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Expense;
use App\Models\FundAllocation;
use App\Models\Purpose;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $approvedDonationStatuses = ['completed'];
        $failedDonationStatuses = ['failed', 'rejected'];

        $totalDonors = Donor::count();
        $totalDonations = Donation::whereIn('status', $approvedDonationStatuses)->sum('amount');
        $totalCampaigns = Campaign::count();
        $totalAllocations = FundAllocation::where('status', 'approved')->sum('amount');
        $totalExpenses = Expense::where('status', 'approved')->sum('amount');

        $pendingApprovals = Donation::where('status', 'pending')->count()
            + Expense::where('status', 'pending')->count()
            + FundAllocation::where('status', 'pending')->count();

        $recentDonations = Donation::with(['donor.user', 'purpose', 'campaign'])
            ->latest()
            ->take(5)
            ->get();

        $purposes = Purpose::withCount([
            'donations',
            'donations as approved_donations_count' => fn ($query) => $query->whereIn('status', $approvedDonationStatuses),
        ])->get();

        $monthlyDonationData = Donation::whereIn('status', $approvedDonationStatuses)
            ->orderBy('donation_date')
            ->get()
            ->groupBy(fn ($donation) => Carbon::parse($donation->donation_date)->format('M'))
            ->map(fn ($group) => round($group->sum('amount'), 2));

        $purposeDonationData = Donation::with('purpose')
            ->whereIn('status', $approvedDonationStatuses)
            ->get()
            ->groupBy(fn ($donation) => optional($donation->purpose)->name ?? 'General')
            ->map(fn ($group) => round($group->sum('amount'), 2));

        $approvalQueue = collect([
            ...Donation::with('donor')->where('status', 'pending')->latest()->take(4)->get()->map(fn ($item) => [
                'type' => 'Donation',
                'title' => optional($item->donor)->full_name ?: 'Donation',
                'amount' => $item->amount,
                'status' => $item->status,
            ]),
            ...Expense::where('status', 'pending')->latest()->take(4)->get()->map(fn ($item) => [
                'type' => 'Expense',
                'title' => $item->title,
                'amount' => $item->amount,
                'status' => $item->status,
            ]),
            ...FundAllocation::where('status', 'pending')->latest()->take(4)->get()->map(fn ($item) => [
                'type' => 'Allocation',
                'title' => $item->reference_no ?: 'Allocation',
                'amount' => $item->amount,
                'status' => $item->status,
            ]),
        ])->take(6);

        $myDrafts = 0;
        $myPendingItems = 0;
        $donorSummary = null;

        if ($user->isStaff()) {
            $myDrafts = Donation::where('submitted_by', $user->id)->where('status', 'draft')->count()
                + Expense::where('submitted_by', $user->id)->where('status', 'draft')->count()
                + FundAllocation::where('submitted_by', $user->id)->where('status', 'draft')->count();

            $myPendingItems = Donation::where('submitted_by', $user->id)->where('status', 'pending')->count()
                + Expense::where('submitted_by', $user->id)->where('status', 'pending')->count()
                + FundAllocation::where('submitted_by', $user->id)->where('status', 'pending')->count();
        }

        if ($user->isDonor() && $user->donor) {
            $donorId = $user->donor->id;

            $donorSummary = [
                'total_amount' => Donation::where('donor_id', $donorId)->whereIn('status', $approvedDonationStatuses)->sum('amount'),
                'total_records' => Donation::where('donor_id', $donorId)->count(),
                'pending_records' => Donation::where('donor_id', $donorId)->where('status', 'pending')->count(),
                'active_campaigns' => Campaign::where('status', 'approved')->count(),
                'recent_donations' => Donation::with(['donor.user','purpose', 'campaign'])
                    ->where('donor_id', $donorId)
                    ->latest()
                    ->take(5)
                    ->get(),
            ];
        }

        return view('dashboard', compact(
            'approvalQueue',
            'donorSummary',
            'monthlyDonationData',
            'myDrafts',
            'myPendingItems',
            'pendingApprovals',
            'purposeDonationData',
            'purposes',
            'recentDonations',
            'totalAllocations',
            'totalCampaigns',
            'totalDonations',
            'totalDonors',
            'totalExpenses',
            'user',
            'approvedDonationStatuses',
            'failedDonationStatuses'
        ));
    }
}