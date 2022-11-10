<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      // $table->timestamp('active')->nullable();
      //$table->string('sku')->nullable();
      $table->string('productName')->nullable();
      $table->foreignId('status_id')->nullable();
      $table->foreignId('warehouse_id')->nullable();
      $table->string('invoice')->unique()->nullable();
      // $table->string('slug')->nullable();
      // $table->unsignedInteger('added_by')->nullable();
      $table->unsignedInteger('user_id')->nullable();
      // $table->unsignedInteger('category_id')->nullable();
      // $table->unsignedInteger('subcategory_id')->nullable();
      // $table->unsignedInteger('subsubcategory_id')->nullable();
      // $table->unsignedInteger('brand_id')->nullable();
      // $table->text('photos')->nullable();
      // $table->string('thumbnail_img')->nullable();
      // $table->string('featured_img')->nullable();
      // $table->string('flash_deal_img')->nullable();
      // $table->string('video_provider')->nullable();
      // $table->string('video_link')->nullable();
      // $table->string('tags')->nullable();
      // $table->text('short_description')->nullable();
      // $table->longText('description')->nullable();
      // $table->boolean('variant_product')->nullable();
      // $table->text('attributes')->nullable();
      // $table->mediumText('choice_options')->nullable();
      // $table->mediumText('colors')->nullable();
      // $table->text('variations')->nullable();
      // $table->integer('todays_deal')->nullable();
      // $table->integer('published')->nullable();
      // $table->integer('featured')->nullable();
      // $table->integer('current_stock')->nullable();
      // $table->unsignedInteger('unit_id')->nullable();
      // $table->double('purchase_price')->nullable();
      // $table->double('unit_price')->nullable();
      // $table->double('discount')->nullable();
      // $table->string('discount_type')->nullable();
      // $table->double('tax')->nullable();
      // $table->string('tax_type')->nullable();


      $table->double('shipping_cost')->nullable();
      $table->foreignId('shipping_id')->nullable();

      // $table->integer('num_of_sale')->nullable();
      // $table->string('meta_title')->nullable();
      // $table->text('meta_description')->nullable();
      // $table->string('meta_img')->nullable();

      // $table->string('pdf')->nullable();
      // $table->double('rating')->nullable();
      $table->string('barcode')->nullable();

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
    Schema::dropIfExists('products');
  }
}
