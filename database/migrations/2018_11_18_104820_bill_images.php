<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BillImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('bill_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bill_id');
            $table->string('file_name');

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
