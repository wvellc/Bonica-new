<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('shape_id')->nullable()->constrained('shapes')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('metal_id')->nullable()->constrained('metals')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('material_id')->nullable()->constrained('materials')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('size_id')->nullable()->constrained('sizes')->onUpdate('CASCADE')->onDelete('cascade');

            $table->integer('quantity')->default(1);
            $table->string('ip_address',60)->nullable();
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
        Schema::dropIfExists('carts');
    }
}
