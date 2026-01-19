<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgerMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Skip if table already exists
        if (Schema::hasTable('ledger_masters')) {
            return;
        }

        Schema::create('ledger_masters', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->enum('type', ['General', 'Party', 'Vehicle', 'Consignee', 'Consignor', 'Self Vehicle'])->index();
            $table->string('name')->index();
            $table->string('short_name')->nullable();
            $table->unsignedBigInteger('under_group_id')->nullable();
            
            // Financial Information
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->enum('dr_cr', ['DR', 'CR'])->default('DR');
            $table->enum('balance_type', ['Debit', 'Credit'])->default('Debit');
            
            // Status
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->index();
            
            // Corporate Details Tab
            $table->string('company_name')->nullable();
            $table->string('company_pan')->nullable();
            $table->string('company_cin')->nullable();
            $table->string('company_gstin')->nullable();
            
            // Address Tab
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('country')->nullable();
            
            // Personal Details Tab
            $table->string('contact_person_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('telephone', 15)->nullable();
            $table->string('fax', 15)->nullable();
            $table->string('contact_person_designation')->nullable();
            
            // GST Verification Tab
            $table->string('gst_number')->nullable();
            $table->enum('gst_registration_type', ['Regular', 'Composition', 'Unregistered'])->nullable();
            $table->date('gst_registration_date')->nullable();
            $table->text('gst_details')->nullable();
            $table->boolean('is_gst_verified')->default(false);
            
            // Additional Fields
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Foreign Keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledger_masters');
    }
}
