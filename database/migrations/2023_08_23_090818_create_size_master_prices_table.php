<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeMasterPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_master_prices', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('size_id')->constrained('sizes')->onUpdate('CASCADE')->onDelete('cascade');
            // $table->foreignId('country_id')->constrained('countries')->onUpdate('CASCADE')->onDelete('cascade');
            $table->decimal('price', 10, 3);
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
        Schema::dropIfExists('size_master_prices');
    }
}
