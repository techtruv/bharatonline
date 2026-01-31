<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('account_groups', function (Blueprint $table) {
            if (!Schema::hasColumn('account_groups', 'status')) {
                $table->enum('status', ['Active', 'Inactive'])->default('Active')->after('under_group_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('account_groups', function (Blueprint $table) {
            if (Schema::hasColumn('account_groups', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
