<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMetalMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_metal_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('metal_id')->constrained('metals')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('material_id')->nullable()->constrained('materials')->onUpdate('CASCADE')->onDelete('cascade');
            $table->decimal('price', 10, 2)->nullable();
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
        Schema::dropIfExists('product_metal_materials');
    }
}
