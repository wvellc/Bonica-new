<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('shape_id')->nullable()->constrained('shapes')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('metal_id')->nullable()->constrained('metals')->onUpdate('CASCADE')->onDelete('cascade');
            $table->string('image',150)->nullable();
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->integer('type')->default(0)->comment('0-image, 1-Video, 2-Video');
            $table->integer('video_type')->default(0)->comment('1- 360 Degree');
            $table->integer('sort_order')->default(0)->nullable();
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
        Schema::dropIfExists('product_images');
    }
}
