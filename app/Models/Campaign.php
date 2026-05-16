<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
    'title',
    'description',
    'tagline',
    'campaign_story',
    'donation_usage',
    'youtube_url',
    'poster_path',
    'funding_goal',
    'amount_raised',
    'amount_used',
    'target_beneficiaries',
    'start_date',
    'end_date',
    'status',
    'created_by',
    'approved_by',
    'approved_at',
    'review_comment',
];

    protected $casts = [
        'funding_goal' => 'decimal:2',
        'amount_raised' => 'decimal:2',
        'amount_used' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function allocations()
    {
        return $this->hasMany(FundAllocation::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /*
    |--------------------------------------------------------------------------
    | NEW: Approved Expenses Helper
    |--------------------------------------------------------------------------
    */

    public function approvedExpenses()
    {
        return $this->expenses()->where('status', 'approved');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function getProgressAttribute()
    {
        if (($this->funding_goal ?? 0) <= 0) {
            return 0;
        }

        return min(
            round(($this->amount_raised / $this->funding_goal) * 100, 2),
            100
        );
    }

    public function getRemainingNeedAttribute()
    {
        return max(
            ($this->funding_goal ?? 0) - ($this->amount_raised ?? 0),
            0
        );
    }

    public function getBalanceAttribute()
    {
        return max(
            ($this->amount_raised ?? 0) - ($this->amount_used ?? 0),
            0
        );
    }

    /*
    |--------------------------------------------------------------------------
    | NEW: Total Approved Expenses
    |--------------------------------------------------------------------------
    */

    public function getTotalApprovedExpensesAttribute()
    {
        return $this->approvedExpenses()->sum('claim_amount');
    }

    /*
    |--------------------------------------------------------------------------
    | NEW: Remaining Donation Balance
    |--------------------------------------------------------------------------
    */

    public function getRemainingDonationBalanceAttribute()
    {
        return max(
            ($this->amount_raised ?? 0) - $this->total_approved_expenses,
            0
        );
    }
}