<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('center_diamond_color_id')->nullable()->constrained('colors')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('center_diamond_clarity_id')->nullable()->constrained('clarities')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('side_diamond_color_id')->nullable()->constrained('colors')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('side_diamond_clarity_id')->nullable()->constrained('clarities')->onUpdate('CASCADE')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            //
        });
    }
}
