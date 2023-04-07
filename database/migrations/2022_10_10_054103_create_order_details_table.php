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
            $table->integer('user_id')->default(0);
            $table->foreignId('order_id')->constrained('orders')->onUpdate('CASCADE')->onDelete('cascade');
            $table->integer('product_id')->default(0);
            $table->string('product_name')->nullable();
            $table->string('product_slug')->nullable();
            $table->integer('category_id')->default(0);
            $table->string('category_slug')->nullable();
            $table->integer('subcategory_id')->default(0);
            $table->string('subcategory_slug')->nullable();
            $table->string('shape')->nullable();
            $table->string('metal')->nullable();
            $table->string('material')->nullable();
            $table->string('size')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('currency_symbol')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->foreignId('order_status_id')->constrained('order_statuses')->onUpdate('CASCADE')->onDelete('cascade');
            $table->string('image',150)->nullable();
            $table->string('image_path')->nullable();
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
