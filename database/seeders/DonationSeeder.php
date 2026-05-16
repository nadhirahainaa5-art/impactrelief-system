<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('donations')->insert([
            [
                'donor_id' => 1,
                'purpose_id' => 1,
                'campaign_id' => 1,
                'amount' => 500.00,
                'payment_method' => 'Bank Transfer',
                'is_online' => false,
                'payment_gateway' => null,
                'transaction_reference' => null,
                'donation_date' => '2026-04-10',
                'type' => 'one-time',
                'receipt_number' => 'REC-1001',
                'receipt_path' => null,
                'status' => 'approved',
                'note' => 'Support for school children',
                'submitted_by' => 1,
                'approved_by' => 1,
                'approved_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'donor_id' => 2,
                'purpose_id' => 2,
                'campaign_id' => 2,
                'amount' => 300.00,
                'payment_method' => 'Cash',
                'is_online' => false,
                'payment_gateway' => null,
                'transaction_reference' => null,
                'donation_date' => '2026-04-11',
                'type' => 'one-time',
                'receipt_number' => 'REC-1002',
                'receipt_path' => null,
                'status' => 'approved',
                'note' => 'Food contribution',
                'submitted_by' => 1,
                'approved_by' => 1,
                'approved_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'donor_id' => 3,
                'purpose_id' => 3,
                'campaign_id' => null,
                'amount' => 1000.00,
                'payment_method' => 'Online Payment',
                'is_online' => true,
                'payment_gateway' => 'ToyyibPay Simulation',
                'transaction_reference' => 'TXN-DEMO-1003',
                'donation_date' => '2026-04-12',
                'type' => 'one-time',
                'receipt_number' => 'REC-1003',
                'receipt_path' => 'sample-receipts/sample-receipt-demo-001.txt',
                'status' => 'approved',
                'note' => 'Medical support fund - online donation simulation',
                'submitted_by' => 1,
                'approved_by' => 1,
                'approved_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
