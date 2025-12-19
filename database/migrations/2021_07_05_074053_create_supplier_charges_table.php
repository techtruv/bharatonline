<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('billType');
            $table->integer('chargesType');
            $table->double('chargesAmount', 16, 2);
            $table->date('chargesDate');
            $table->text('notes')->nullable();
            $table->integer('trip_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('page')->default('3');
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
        Schema::dropIfExists('supplier_charges');
    }
}
