<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FundAllocationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fund_allocations')->insert([
            [
                'purpose_id' => 1,
                'campaign_id' => 1,
                'amount' => 3000.00,
                'allocation_date' => '2026-04-13',
                'reference_no' => 'ALLOC-1001',
                'note' => 'Allocation for school supplies program',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purpose_id' => 2,
                'campaign_id' => 2,
                'amount' => 2000.00,
                'allocation_date' => '2026-04-14',
                'reference_no' => 'ALLOC-1002',
                'note' => 'Allocation for food basket distribution',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
