<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddExtraFieldTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->string('endKmsReading')->nullable()->after('startKmsReading');
            $table->date('pod_receuve_date')->nullable()->after('endKmsReading');
            $table->string('pod_receuve_doc')->nullable()->after('pod_receuve_date');
            $table->date('pod_submitted_date')->nullable()->after('pod_receuve_doc');
            $table->date('settelement_date')->nullable()->after('pod_submitted_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_extra_field_trips');
    }
}
