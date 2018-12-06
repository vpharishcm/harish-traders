<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('supplier_id');
            $table->date('bill_date');
            $table->decimal('amount',12,2);
            $table->boolean('bill_status');
            
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
