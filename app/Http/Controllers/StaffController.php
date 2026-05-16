<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Expense;
use App\Models\FundAllocation;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function dashboard(): View
    {
        $user = auth()->user();

        $campaigns = Campaign::withSum([
                'donations as completed_donations_sum' => function ($query) {
                    $query->where('status', 'completed');
                }
            ], 'amount')
            ->where('created_by', $user->id)
            ->latest()
            ->get()
            ->map(function ($campaign) {
                $campaign->amount_raised = $campaign->completed_donations_sum ?? 0;
                return $campaign;
            });

        $campaignIds = $campaigns->pluck('id');

        $totalCampaigns = $campaigns->count();

        $approvedCampaigns = $campaigns->where('status', 'approved')->count();
        $pendingCampaigns = $campaigns->where('status', 'pending')->count();
        $reviewCampaigns = $campaigns->where('status', 'under_review')->count();
        $rejectedCampaigns = $campaigns->where('status', 'rejected')->count();

        $totalGoal = $campaigns->sum('funding_goal');
        $totalRaised = $campaigns->sum('amount_raised');
        $totalUsed = $campaigns->sum('amount_used');

        $remaining = max($totalGoal - $totalRaised, 0);

        $allocations = FundAllocation::whereIn('campaign_id', $campaignIds)
            ->latest()
            ->take(6)
            ->get();

        $expenses = Expense::whereIn('campaign_id', $campaignIds)
            ->latest()
            ->take(6)
            ->get();

        $recentCampaigns = $campaigns->take(6);

        return view('staff.dashboard', compact(
            'totalCampaigns',
            'approvedCampaigns',
            'pendingCampaigns',
            'reviewCampaigns',
            'rejectedCampaigns',
            'totalGoal',
            'totalRaised',
            'totalUsed',
            'remaining',
            'allocations',
            'expenses',
            'recentCampaigns'
        ));
    }
}