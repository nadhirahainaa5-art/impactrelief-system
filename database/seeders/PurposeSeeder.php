<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PurposeSeeder extends Seeder
{
    public function run(): void
    {
        $purposes = [
            ['name' => 'Education', 'description' => 'Scholarships and school supplies'],
            ['name' => 'Food Aid', 'description' => 'Food support for families'],
            ['name' => 'Health', 'description' => 'Medical and treatment support'],
            ['name' => 'Emergency Relief', 'description' => 'Emergency disaster response'],
            ['name' => 'General Fund', 'description' => 'General donation fund'],
        ];

        foreach ($purposes as $purpose) {
            DB::table('purposes')->insert([
                'name' => $purpose['name'],
                'slug' => Str::slug($purpose['name']),
                'description' => $purpose['description'],
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

