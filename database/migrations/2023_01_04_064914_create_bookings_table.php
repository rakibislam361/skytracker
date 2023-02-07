<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->integer('user_id')->nullable();

            $table->foreignId('carton_id')->nullable();

            $table->string('ctnQuantity')->nullable();
            $table->string('totalCbm')->nullable();
            $table->string('productQuantity')->nullable();
            $table->string('productsTotalCost')->nullable();
            $table->string('othersProductName')->nullable();
            $table->string('bookingProduct')->nullable();

            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();

            $table->string('shipping_mark')->nullable();
            $table->string('shipping_number')->nullable();
            $table->string('actual_weight')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('chinalocal')->nullable();
            $table->string('packing_cost')->nullable();
            $table->string('courier_bill')->nullable();
            $table->double('amount')->nullable();
            $table->string('paid')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
