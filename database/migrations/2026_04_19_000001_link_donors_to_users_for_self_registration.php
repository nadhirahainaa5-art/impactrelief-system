<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            if (! Schema::hasColumn('donors', 'user_id')) {
                $table->foreignId('user_id')->nullable()->unique()->after('id')->constrained('users')->nullOnDelete();
            }
        });

        DB::statement("
            UPDATE donors
            SET user_id = (
                SELECT users.id
                FROM users
                WHERE users.email = donors.email
                LIMIT 1
            )
            WHERE donors.email IS NOT NULL AND user_id IS NULL
        ");

        DB::table('users')->whereNull('role')->update(['role' => 'donor']);
    }

    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            if (Schema::hasColumn('donors', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
