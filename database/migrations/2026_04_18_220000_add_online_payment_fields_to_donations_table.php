<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            if (! Schema::hasColumn('donations', 'is_online')) {
                $table->boolean('is_online')->default(false)->after('payment_method');
            }

            if (! Schema::hasColumn('donations', 'payment_gateway')) {
                $table->string('payment_gateway')->nullable()->after('is_online');
            }

            if (! Schema::hasColumn('donations', 'transaction_reference')) {
                $table->string('transaction_reference')->nullable()->unique()->after('payment_gateway');
            }

            if (! Schema::hasColumn('donations', 'receipt_path')) {
                $table->string('receipt_path')->nullable()->after('receipt_number');
            }
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            foreach (['receipt_path', 'transaction_reference', 'payment_gateway', 'is_online'] as $column) {
                if (Schema::hasColumn('donations', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
