<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('campaigns')->insert([
            [
                'title' => 'Back to School 2026',
                'description' => 'Support students with school supplies',
                'funding_goal' => 20000.00,
                'amount_raised' => 0,
                'amount_used' => 0,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'status' => 'active',
                'target_beneficiaries' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ramadan Food Basket',
                'description' => 'Food aid for needy families',
                'funding_goal' => 15000.00,
                'amount_raised' => 0,
                'amount_used' => 0,
                'start_date' => '2026-02-01',
                'end_date' => '2026-04-30',
                'status' => 'active',
                'target_beneficiaries' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

