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
        Schema::table('party_payments', function (Blueprint $table) {
            $table->enum('payment_method', ['cash', 'bank_transfer', 'check', 'upi'])->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('party_payments', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
            $table->dropColumn(['payment_method', 'bank_id']);
        });
    }
};
