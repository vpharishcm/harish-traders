<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Billproducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('bill_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('product_id');
            $table->decimal('price',8,2);
            $table->decimal('quantity',10,2);

            $table->foreign('bill_id')->references('id')->on('bills');
            $table->foreign('product_id')->references('id')->on('products');
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
