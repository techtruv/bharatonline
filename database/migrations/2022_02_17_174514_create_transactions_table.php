<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_type',10);
            $table->tinyInteger('pay_type');
            $table->tinyInteger('head_type');
            $table->double('amount',16,2);
            $table->date('trans_date');
            $table->string('notes');
            $table->string('document',100);
            $table->integer('page')->comment('10:expenses,11:income');
            $table->integer('status')->comment('1:delete,0:not-delete')->default(0);
            $table->tinyInteger('createdby');
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
        Schema::dropIfExists('transactions');
    }
}
