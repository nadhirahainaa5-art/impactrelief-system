<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\View\View;

class DonorController extends Controller
{
    public function dashboard(): View
    {
        $campaigns = Campaign::where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        $donor = Donor::where('user_id', auth()->id())->first();

        if ($donor) {
            $myDonations = Donation::where('donor_id', $donor->id)
                ->where('status', 'completed')
                ->get();

            $totalDonated = $myDonations->sum('amount');

            $totalMyDonations = $myDonations->count();

            $supportedCampaigns = $myDonations
                ->pluck('campaign_id')
                ->unique()
                ->count();
        } else {
            $totalDonated = 0;
            $totalMyDonations = 0;
            $supportedCampaigns = 0;
        }

        return view('donor.dashboard', compact(
            'campaigns',
            'totalDonated',
            'totalMyDonations',
            'supportedCampaigns'
        ));
    }
}