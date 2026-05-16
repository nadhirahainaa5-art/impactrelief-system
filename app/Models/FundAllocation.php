<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundAllocation extends Model
{
    protected $table = 'fund_allocations';

    protected $fillable = [
        'purpose_id',
        'campaign_id',
        'amount',
        'allocation_date',
        'reference_no',
        'note',
        'status',
        'submitted_by',
        'approved_by',
        'approved_at',
        'review_comment',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'allocation_date' => 'date',
        'approved_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function purpose()
    {
        return $this->belongsTo(Purpose::class);
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