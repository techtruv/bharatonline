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
        // Skip if table already exists
        if (Schema::hasTable('hsn_masters')) {
            return;
        }

        Schema::create('hsn_masters', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('hsn_code', 8)->unique()->comment('HSN/SAC Code (6-8 digits)');
            $table->enum('hsn_type', ['HSN', 'SAC'])->default('HSN')->comment('Type: HSN (Goods) or SAC (Services)');
            $table->string('commodity_name')->comment('Name of the commodity/service');
            $table->text('description')->nullable()->comment('Detailed description of commodity');
            
            // GST Tax Rates
            $table->decimal('sgst_rate', 5, 2)->default(0)->comment('SGST Rate (0, 5, 12, 18, 28)');
            $table->decimal('cgst_rate', 5, 2)->default(0)->comment('CGST Rate (0, 5, 12, 18, 28)');
            $table->decimal('igst_rate', 5, 2)->default(0)->comment('IGST Rate (0, 5, 12, 18, 28)');
            $table->decimal('cess_rate', 5, 2)->default(0)->comment('Cess Rate (if applicable)');
            
            // Computed Tax Rates
            $table->decimal('total_gst_rate', 5, 2)->virtualAs('sgst_rate + cgst_rate')->comment('Total GST (SGST + CGST)');
            $table->decimal('total_tax_rate', 5, 2)->virtualAs('sgst_rate + cgst_rate + cess_rate')->comment('Total Tax with Cess');
            
            // HSN Specific Details
            $table->string('unit_of_measurement', 20)->nullable()->comment('UOM (Pcs, Kg, Litre, etc)');
            $table->string('standard_description', 100)->nullable()->comment('Standard HSN Description');
            $table->string('chapter_number', 10)->nullable()->comment('Chapter Number (01-99)');
            
            // Additional Details
            $table->text('remarks')->nullable()->comment('Any additional remarks or notes');
            $table->boolean('is_active')->default(true)->comment('Status: Active or Inactive');
            $table->boolean('is_exempted')->default(false)->comment('Is GST Exempted?');
            $table->boolean('is_nil_rated')->default(false)->comment('Is Nil Rated?');
            
            // Audit Fields
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Foreign Keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            
            // Indexes
            $table->index('hsn_code');
            $table->index('hsn_type');
            $table->index('is_active');
            $table->index('chapter_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hsn_masters');
    }
};
