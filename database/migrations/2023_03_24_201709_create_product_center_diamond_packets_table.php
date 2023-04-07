<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCenterDiamondPacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_center_diamond_packets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('packet_id')->constrained('packets')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('shape_id')->constrained('shapes')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('clarity_id')->constrained('clarities')->onUpdate('CASCADE')->onDelete('cascade');
            $table->float('weight')->nullable()->comment('weight in CT');
            $table->float('pcs')->nullable()->comment('Diamods Pcs');
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('product_center_diamond_packets');
    }
}
