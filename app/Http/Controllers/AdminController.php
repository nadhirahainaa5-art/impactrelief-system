<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Expense;
use App\Models\FundAllocation;
use App\Models\User;
use App\Http\Controllers\ProfileController;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $totalCampaigns = Campaign::count();
        $approvedCampaigns = Campaign::where('status', 'approved')->count();
        $pendingCampaigns = Campaign::where('status', 'pending')->count();
        $reviewCampaigns = Campaign::where('status', 'under_review')->count();
        $rejectedCampaigns = Campaign::where('status', 'rejected')->count();

        $selectedCampaign = request('campaign');

$campaigns = Campaign::where('status', 'approved')->get();

if ($selectedCampaign && $selectedCampaign != 'all') {

    $totalDonations = Donation::where('campaign_id', $selectedCampaign)
        ->sum('amount');

    $totalAllocations = FundAllocation::where('campaign_id', $selectedCampaign)
        ->where('status', 'approved')
        ->sum('amount');

    $totalExpenses = Expense::where('campaign_id', $selectedCampaign)
    ->where('status', 'approved')
    ->sum('amount');

} else {

    $totalDonations = Donation::sum('amount');

    $totalAllocations = FundAllocation::where('status', 'approved')
        ->sum('amount');

    $totalExpenses = Expense::where('status', 'approved')
    ->sum('amount');
}

        $donors = User::where('role', 'donor')->count();
        $staff = User::where('role', 'staff')->count();

        $latestCampaigns = Campaign::latest()->take(6)->get();

        $latestAllocations = FundAllocation::latest()->take(6)->get();

        $latestExpenses = Expense::latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalCampaigns',
            'approvedCampaigns',
            'pendingCampaigns',
            'reviewCampaigns',
            'rejectedCampaigns',
            'campaigns',
            'selectedCampaign',
            'totalDonations',
            'totalAllocations',
            'totalExpenses',
            'donors',
            'staff',
            'latestCampaigns',
            'latestAllocations',
            'latestExpenses'
        ));
    }
}