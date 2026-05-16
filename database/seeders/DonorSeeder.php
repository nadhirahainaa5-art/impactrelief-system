<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('donors')->insert([
            [
                'user_id' => 3,
                'full_name' => 'Donor Demo',
                'email' => 'donor@ngo.com',
                'phone' => '0123456789',
                'address' => 'Kuala Lumpur, Malaysia',
                'preferred_purpose' => 'Education',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Siti Aisyah',
                'email' => 'siti@example.com',
                'phone' => '0139876543',
                'address' => 'Shah Alam, Malaysia',
                'preferred_purpose' => 'Food Aid',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Daniel Lee',
                'email' => 'daniel@example.com',
                'phone' => '0141234567',
                'address' => 'Penang, Malaysia',
                'preferred_purpose' => 'Health',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}