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
        Schema::table('l_r_lists', function (Blueprint $table) {
            $table->integer('quantity')->nullable()->after('details');
            $table->decimal('weight', 8, 2)->nullable()->after('quantity');
            $table->string('dimensions', 50)->nullable()->after('weight');
            $table->decimal('value', 12, 2)->nullable()->after('dimensions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('l_r_lists', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'weight', 'dimensions', 'value']);
        });
    }
};
