<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Campaign;
use App\Models\FundAllocation;
use App\Models\User;

class Expense extends Model
{
    protected $fillable = [
        'fund_allocation_id',
        'purpose_id',
        'campaign_id',
        'expense_type',
        'amount',
        'expense_date',
        'vendor',
        'receipt',
        'description',
        'status',
        'submitted_by',
        'approved_by',
        'approved_at',
        'review_comment',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
        'approved_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function fundAllocation()
    {
        return $this->belongsTo(FundAllocation::class);
    }

    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}