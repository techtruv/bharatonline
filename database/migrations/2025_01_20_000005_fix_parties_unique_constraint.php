<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixPartiesUniqueConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parties', function (Blueprint $table) {
            // Add is_party field if it doesn't exist
            if (!Schema::hasColumn('parties', 'is_party')) {
                $table->boolean('is_party')->default(0)->after('type')->comment('1 if also saved as Party, 0 if only Consignor');
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
            if (Schema::hasColumn('parties', 'is_party')) {
                $table->dropColumn('is_party');
            }
        });
    }
}
