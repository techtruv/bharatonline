<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLRListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_r_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id')->nullable();
            $table->string('lr_no',20)->nullable();
            $table->string('material')->nullable();
            $table->string('details')->nullable();
            $table->integer('createdby')->nullable();
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
        Schema::dropIfExists('l_r_lists');
    }
}
