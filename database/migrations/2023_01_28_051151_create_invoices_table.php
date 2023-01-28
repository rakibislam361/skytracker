<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->double('total_payable')->nullable();
            $table->double('total_courier')->nullable();
            $table->double('total_due')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('delivery_method')->nullable();

            $table->string('product_name')->nullable();
            $table->string('product_cost')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('cbm')->nullable();
            $table->string('carton_qty')->nullable();
            $table->string('warehouse_qty')->nullable();
            $table->string('carton_number')->nullable();
            $table->string('shipping_mark')->nullable();
            $table->string('shipping_number')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('actual_weight')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('remarks')->nullable();
            $table->string('amount')->nullable();

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
        Schema::dropIfExists('invoices');
    }
}
