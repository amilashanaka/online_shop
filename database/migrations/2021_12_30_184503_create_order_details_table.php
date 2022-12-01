<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('qty');
            $table->double('amount');
            $table->double('total');
            $table->double('commission');
            $table->smallInteger('status')->comment('1-Delivered, 2 -Returned');
            $table->foreignId('order_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('product_sku_id')->constrained();
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
        Schema::dropIfExists('order_details');
    }
}
