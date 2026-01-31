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
        Schema::table('ledger_masters', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('ledger_masters', 'whatsapp')) {
                $table->string('whatsapp', 15)->nullable()->after('telephone');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'contact_person_mobile_2')) {
                $table->string('contact_person_mobile_2', 15)->nullable()->after('contact_person_designation');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'pan_no')) {
                $table->string('pan_no', 20)->nullable()->after('contact_person_mobile_2');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'aadhar_no')) {
                $table->string('aadhar_no', 20)->nullable()->after('pan_no');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'service_tax_no')) {
                $table->string('service_tax_no', 20)->nullable()->after('aadhar_no');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'credit_days')) {
                $table->integer('credit_days')->nullable()->after('service_tax_no');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'credit_limit')) {
                $table->decimal('credit_limit', 15, 2)->nullable()->after('credit_days');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'credit_bills')) {
                $table->integer('credit_bills')->nullable()->after('credit_limit');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'follow_up')) {
                $table->enum('follow_up', ['Inform Only', 'Stop Billing'])->nullable()->after('credit_bills');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'collection_day')) {
                $table->integer('collection_day')->nullable()->after('follow_up');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'category')) {
                $table->enum('category', ['Distributor', 'Stockist', 'Wholesaler', 'Retailer', 'None'])->default('None')->after('collection_day');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'bill_desc_percent')) {
                $table->decimal('bill_desc_percent', 5, 2)->default(0)->after('category');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'bank_name')) {
                $table->string('bank_name')->nullable()->after('bill_desc_percent');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'bank_branch')) {
                $table->string('bank_branch')->nullable()->after('bank_name');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'ifsc_code')) {
                $table->string('ifsc_code', 11)->nullable()->after('bank_branch');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'account_no')) {
                $table->string('account_no', 50)->nullable()->after('ifsc_code');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'bank_address')) {
                $table->text('bank_address')->nullable()->after('account_no');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'dob')) {
                $table->date('dob')->nullable()->after('bank_address');
            }
            
            if (!Schema::hasColumn('ledger_masters', 'dom')) {
                $table->date('dom')->nullable()->after('dob');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ledger_masters', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp',
                'contact_person_mobile_2',
                'pan_no',
                'aadhar_no',
                'service_tax_no',
                'credit_days',
                'credit_limit',
                'credit_bills',
                'follow_up',
                'collection_day',
                'category',
                'bill_desc_percent',
                'bank_name',
                'bank_branch',
                'ifsc_code',
                'account_no',
                'bank_address',
                'dob',
                'dom',
            ]);
        });
    }
};
