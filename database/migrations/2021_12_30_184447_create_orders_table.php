<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference_id');
            $table->double('amount');
            $table->double('commission');
            $table->smallInteger('status')->comment('0-Pending, 1-Confirmed, 2 -Approved, 3- Cancelled');
            $table->smallInteger('payment_type')->comment('1- Cash, 2- Trn');
            $table->string('otp');
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('orders');
    }
}
