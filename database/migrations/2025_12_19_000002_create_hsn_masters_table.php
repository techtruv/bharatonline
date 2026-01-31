<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHsnMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hsn_masters', function (Blueprint $table) {
            $table->id();
            $table->string('hsn_code')->unique();
            $table->string('type');
            $table->string('commodity');
            $table->decimal('sgst_percent', 5, 2);
            $table->decimal('cgst_percent', 5, 2);
            $table->decimal('igst_percent', 5, 2);
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
        Schema::dropIfExists('hsn_masters');
    }
}
