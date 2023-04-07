<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('diamond_size')->nullable();
            $table->foreignId('shape_id')->constrained('shapes')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('clarity_id')->constrained('clarities')->onUpdate('CASCADE')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->boolean('status', 1)->default(1)->comment('1-Active, 0-Inactive');
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
        Schema::dropIfExists('packets');
    }
}
