<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('expensesType');
            $table->double('expensesAmount',16,2);
            $table->date('expensesDate');
            $table->integer('payType')->nullable();
            $table->text('notes')->nullable();
            $table->integer('trip_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('page')->default('1');
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
        Schema::dropIfExists('expenses');
    }
}
