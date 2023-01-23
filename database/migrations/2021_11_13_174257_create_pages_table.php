<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pages', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->text("title")->nullable();
      $table->string("slug", 255)->nullable();
      $table->string("bgcolor", 255)->nullable();
      $table->string("image", 255)->nullable();
      $table->longText("description")->nullable();
      $table->integer("hearder")->nullable();
      $table->integer("footer_left")->nullable();
      $table->integer("footer_right")->nullable();
      $table->integer("is_active");
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
    Schema::dropIfExists('pages');
  }
}
