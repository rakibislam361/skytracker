<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartons', function (Blueprint $table) {
            $table->increments('id');
            // $table->foreignId('booking_id')->nullable();
            $table->string('carton_number')->nullable();
            $table->string('actual_weight')->nullable();
            $table->string('warehouse_quantity')->nullable();
            $table->string('shipping_mark')->nullable();
            $table->string('shipping_number')->nullable();
            $table->string('tracking_id')->nullable();
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
        Schema::dropIfExists('cartons');
    }
}
