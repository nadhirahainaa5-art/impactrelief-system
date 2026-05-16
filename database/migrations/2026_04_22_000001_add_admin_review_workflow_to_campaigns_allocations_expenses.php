<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('target_beneficiaries')->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable()->after('approved_by');
            $table->text('review_comment')->nullable()->after('approved_at');
        });

        Schema::table('fund_allocations', function (Blueprint $table) {
            $table->text('review_comment')->nullable()->after('approved_at');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->text('review_comment')->nullable()->after('approved_at');
        });

        // Existing data alignment
        DB::table('campaigns')
            ->where('status', 'active')
            ->update(['status' => 'approved']);

        DB::table('campaigns')
            ->whereNull('status')
            ->update(['status' => 'pending']);

        DB::table('fund_allocations')
            ->whereNull('status')
            ->update(['status' => 'pending']);

        DB::table('expenses')
            ->whereNull('status')
            ->update(['status' => 'pending']);
    }

    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropConstrainedForeignId('approved_by');
            $table->dropConstrainedForeignId('created_by');
            $table->dropColumn(['approved_at', 'review_comment']);
        });

        Schema::table('fund_allocations', function (Blueprint $table) {
            $table->dropColumn('review_comment');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('review_comment');
        });
    }
};   