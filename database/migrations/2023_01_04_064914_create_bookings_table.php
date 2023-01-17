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
            $table->bigIncrements('id');
            $table->string('date');
            $table->integer('user_id')->nullable();
            $table->string('ctnQuantity')->nullable();
            $table->string('totalCbm')->nullable();
            $table->string('productQuantity')->nullable();
            $table->string('productsTotalCost')->nullable();
            $table->string('othersProductName')->nullable();
            $table->string('bookingProduct')->nullable();
            $table->string('shipping_mark')->nullable();
            $table->string('carton_number')->nullable();
            $table->string('shipping_number')->nullable();
            $table->string('actual_weight')->nullable();
            $table->string('unit_price')->nullable();
            $table->double('amount')->nullable();
            $table->string('tracking_id')->nullable();
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
