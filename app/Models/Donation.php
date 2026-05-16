<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'campaign_id',
        'purpose_id',
        'donor_id',
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'donation_date',
        'payment_method',
        'payment_gateway',
        'transaction_reference',
        'type',
        'receipt_number',
        'receipt_path',
        'status',
        'note',
        'submitted_by',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'donation_date' => 'date',
        'approved_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id');
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}