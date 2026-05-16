<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('expenses')->insert([
            [
                'purpose_id' => 1,
                'campaign_id' => 1,
                'title' => 'Purchase of School Bags',
                'category' => 'Education Materials',
                'amount' => 1200.00,
                'expense_date' => '2026-04-15',
                'vendor' => 'ABC Stationery',
                'receipt_number' => 'EXP-1001',
                'description' => 'Bought school bags for student beneficiaries',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purpose_id' => 2,
                'campaign_id' => 2,
                'title' => 'Food Pack Supplies',
                'category' => 'Food Aid',
                'amount' => 850.00,
                'expense_date' => '2026-04-16',
                'vendor' => 'Fresh Mart',
                'receipt_number' => 'EXP-1002',
                'description' => 'Purchased rice, oil, and dry food items',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

