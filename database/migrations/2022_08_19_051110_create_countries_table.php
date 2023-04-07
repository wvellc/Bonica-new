<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('slug')->nullable()->unique();
            $table->string('code',20);
            $table->string('flag',150)->nullable();
            $table->string('currency',150)->nullable();
            $table->string('currency_code',150)->nullable();
            $table->string('symbol',150)->nullable();
            $table->decimal('rate', 10, 2)->nullable();
            $table->decimal('shipping_charge', 10, 2)->default(0)->nullable();
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
        Schema::dropIfExists('countries');
    }
}
