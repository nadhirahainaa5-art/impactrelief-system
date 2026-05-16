<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuditLogSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('audit_logs')->insert([
            [
                'user_id' => 1,
                'action' => 'create',
                'module' => 'donations',
                'record_id' => 1,
                'description' => 'Created donation record REC-1001',
                'properties' => json_encode([
                    'receipt_number' => 'REC-1001',
                    'amount' => 500.00,
                ]),
                'performed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'action' => 'allocate',
                'module' => 'fund_allocations',
                'record_id' => 1,
                'description' => 'Allocated funds to Back to School 2026 campaign',
                'properties' => json_encode([
                    'reference_no' => 'ALLOC-1001',
                    'amount' => 3000.00,
                ]),
                'performed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
