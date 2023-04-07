<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('topic',150);
            $table->string('slug')->nullable()->unique();
            $table->string('icon',190)->nullable();
            $table->boolean('status')->default(true)->comment('1-Active, 0-Inactive');
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
        Schema::dropIfExists('category_faqs');
    }
}
