<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Billexpences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bill_expences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expence_id');
            $table->unsignedInteger('bill_id');
            $table->decimal('amount',10,2);

            $table->foreign('expence_id')->references('id')->on('expences');
            $table->foreign('bill_id')->references('id')->on('bills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
