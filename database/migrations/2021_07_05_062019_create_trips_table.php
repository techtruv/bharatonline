<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('partyName');
            $table->bigInteger('vehicleNumber');
            $table->bigInteger('driverName')->nullable();
            $table->bigInteger('supplierName')->nullable();
            $table->bigInteger('origin');
            $table->bigInteger('destination');
            $table->bigInteger('billingType');
            $table->double('party_rate_per',16,2)->nullable();
            $table->double('party_unit_per',16,2)->nullable();
            $table->double('partyFreightAmount',16,2);
            $table->bigInteger('supplierBillingType')->nullable();
            $table->double('truck_rate_per',16,2)->nullable();
            $table->double('truck_unit_per',16,2)->nullable();
            $table->double('truckHireAmount',16,2)->nullable();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->string('startKmsReading')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
