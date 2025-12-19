<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parties', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('parties', 'type')) {
                $table->enum('type', ['Party', 'Consignor'])->default('Party')->after('partyName');
            }
            if (!Schema::hasColumn('parties', 'address')) {
                $table->text('address')->nullable()->after('type');
            }
            if (!Schema::hasColumn('parties', 'phone_no')) {
                $table->string('phone_no', 20)->nullable()->after('address');
            }
            if (!Schema::hasColumn('parties', 'mobile_no')) {
                $table->string('mobile_no', 20)->nullable()->after('phone_no');
            }
            if (!Schema::hasColumn('parties', 'contact_person_name')) {
                $table->string('contact_person_name')->nullable()->after('mobile_no');
            }
            if (!Schema::hasColumn('parties', 'contact_mobile_number')) {
                $table->string('contact_mobile_number', 20)->nullable()->after('contact_person_name');
            }
            if (!Schema::hasColumn('parties', 'tin_no')) {
                $table->string('tin_no')->nullable()->unique()->after('contact_mobile_number');
            }
            if (!Schema::hasColumn('parties', 'gst_no')) {
                $table->string('gst_no')->nullable()->unique()->after('tin_no');
            }
            if (!Schema::hasColumn('parties', 'email')) {
                $table->string('email')->nullable()->after('gst_no');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parties', function (Blueprint $table) {
            $columns = ['type', 'address', 'phone_no', 'mobile_no', 'contact_person_name', 'contact_mobile_number', 'tin_no', 'gst_no', 'email'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('parties', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
