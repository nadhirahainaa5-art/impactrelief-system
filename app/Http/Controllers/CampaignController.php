<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CampaignController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $query = Campaign::latest();

        if ($user->isAdmin()) {
            $campaigns = $query->get();
        } elseif ($user->isStaff()) {
            $campaigns = $query
                ->where('created_by', $user->id)
                ->get();
        } else {
            $campaigns = $query
                ->where('status', 'approved')
                ->get();
        }

        return view('campaigns.index', compact('campaigns'));
    }

    public function create(): View
    {
        abort_unless(auth()->user()->isStaff(), 403);

        return view('campaigns.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();

        abort_unless($user->isStaff(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'campaign_story' => 'nullable|string',
            'donation_usage' => 'nullable|string',
            'youtube_url' => 'nullable|string',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'funding_goal' => 'required|numeric|min:1',
            'target_beneficiaries' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $posterPath = null;

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('campaign-posters', 'public');
        }

        Campaign::create([
            'title' => $validated['title'],
            'tagline' => $validated['tagline'] ?? null,
            'campaign_story' => $validated['campaign_story'] ?? null,
            'donation_usage' => $validated['donation_usage'] ?? null,
            'youtube_url' => $validated['youtube_url'] ?? null,

            // Keep description filled for old pages/system compatibility
            'description' => $validated['campaign_story']
                ?? $validated['description']
                ?? $validated['tagline']
                ?? null,

            'poster_path' => $posterPath,
            'funding_goal' => $validated['funding_goal'],
            'amount_raised' => 0,
            'amount_used' => 0,
            'target_beneficiaries' => $validated['target_beneficiaries'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'status' => 'pending',
            'created_by' => $user->id,
            'approved_by' => null,
            'approved_at' => null,
            'review_comment' => null,
        ]);

        return redirect()
            ->route('campaigns.index')
            ->with('success', 'Campaign submitted for admin review.');
    }

    public function show(Campaign $campaign): View
    {
        $user = auth()->user();

        if ($user->isDonor() && $campaign->status !== 'approved') {
            abort(404);
        }

        if ($user->isStaff() && $campaign->created_by !== $user->id) {
            abort(403);
        }

        $approvedExpenses = $campaign->expenses()
            ->where('status', 'approved')
            ->latest()
            ->get();

        $totalExpensesUsed = $approvedExpenses->sum('claim_amount');

        $remainingBalance = max(
            $campaign->amount_raised - $totalExpensesUsed,
            0
        );

        return view('campaigns.show', compact(
            'campaign',
            'approvedExpenses',
            'totalExpensesUsed',
            'remainingBalance'
        ));
    }

    public function edit(Campaign $campaign): View
    {
        $user = auth()->user();

        abort_unless($user->isStaff(), 403);

        if ($campaign->created_by !== $user->id) {
            abort(403);
        }

        abort_unless(in_array($campaign->status, ['pending', 'under_review']), 403);

        return view('campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign): RedirectResponse
    {
        $user = auth()->user();

        abort_unless($user->isStaff(), 403);

        if ($campaign->created_by !== $user->id) {
            abort(403);
        }

        abort_unless(in_array($campaign->status, ['pending', 'under_review']), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'campaign_story' => 'nullable|string',
            'donation_usage' => 'nullable|string',
            'youtube_url' => 'nullable|string',
            'description' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'funding_goal' => 'required|numeric|min:1',
            'target_beneficiaries' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $posterPath = $campaign->poster_path;

        if ($request->hasFile('poster')) {
            if ($campaign->poster_path) {
                Storage::disk('public')->delete($campaign->poster_path);
            }

            $posterPath = $request->file('poster')->store('campaign-posters', 'public');
        }

        $campaign->update([
            'title' => $validated['title'],
            'tagline' => $validated['tagline'] ?? null,
            'campaign_story' => $validated['campaign_story'] ?? null,
            'donation_usage' => $validated['donation_usage'] ?? null,
            'youtube_url' => $validated['youtube_url'] ?? null,

            // Keep description filled for old pages/system compatibility
            'description' => $validated['campaign_story']
                ?? $validated['description']
                ?? $validated['tagline']
                ?? null,

            'poster_path' => $posterPath,
            'funding_goal' => $validated['funding_goal'],
            'target_beneficiaries' => $validated['target_beneficiaries'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'status' => 'pending',
            'review_comment' => null,
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return redirect()
            ->route('campaigns.index')
            ->with('success', 'Campaign updated and resubmitted.');
    }

    public function destroy(Campaign $campaign): RedirectResponse
    {
        $user = auth()->user();

        abort_unless($user->isStaff() || $user->isAdmin(), 403);

        if ($user->isStaff() && $campaign->created_by !== $user->id) {
            abort(403);
        }

        if ($campaign->poster_path) {
            Storage::disk('public')->delete($campaign->poster_path);
        }

        $campaign->delete();

        return redirect()
            ->route('campaigns.index')
            ->with('success', 'Campaign deleted.');
    }

    public function approve(Campaign $campaign): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        abort_if(
            in_array($campaign->status, ['approved', 'rejected']),
            403,
            'This campaign is already finalized.'
        );

        $campaign->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'review_comment' => null,
        ]);

        return back()->with('success', 'Campaign approved.');
    }

    public function reject(Request $request, Campaign $campaign): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        abort_if(
            in_array($campaign->status, ['approved', 'rejected']),
            403,
            'This campaign is already finalized.'
        );

        $validated = $request->validate([
            'review_comment' => 'required|string',
        ]);

        $campaign->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'review_comment' => $validated['review_comment'],
        ]);

        return back()->with('success', 'Campaign rejected.');
    }

    public function review(Request $request, Campaign $campaign): RedirectResponse
    {
        abort_unless(auth()->user()->isAdmin(), 403);

        abort_if(
            in_array($campaign->status, ['approved', 'rejected']),
            403,
            'This campaign is already finalized.'
        );

        $validated = $request->validate([
            'review_comment' => 'required|string',
        ]);

        $campaign->update([
            'status' => 'under_review',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'review_comment' => $validated['review_comment'],
        ]);

        return back()->with('success', 'Campaign marked under review.');
    }
}