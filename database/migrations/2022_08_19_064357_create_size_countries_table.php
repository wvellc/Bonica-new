<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_countries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('size_id')->nullable()->constrained('sizes')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->constrained('countries')->onUpdate('CASCADE')->onDelete('cascade');
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
        Schema::dropIfExists('size_countries');
    }
}
