<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialMetalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_metals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('metal_id')->constrained('metals')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('material_id')->nullable()->constrained('materials')->onUpdate('CASCADE')->onDelete('cascade');
            $table->decimal('price', 10, 2)->nullable()->comment('per gram price');
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
        Schema::dropIfExists('material_metals');
    }
}
