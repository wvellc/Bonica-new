<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',190);
            $table->string('slug')->nullable()->unique();
            $table->integer('parent_id')->default(0)->nullable();
            $table->string('image',190)->nullable();
            $table->string('icon',190)->nullable();
            $table->string('banner_image',190)->nullable();
            $table->string('discover_image')->nullable();
            $table->boolean('discover_status')->default(true)->comment('1-Active, 0-Inactive');
            $table->string('shopthelook_image')->nullable();
            $table->boolean('shopthelook_status')->default(true)->comment('1-Active, 0-Inactive');
            $table->text('description')->nullable();
            $table->boolean('is_show_size_chart', 1)->default(0)->comment('1-Yes, 0-No');
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('status')->default(true)->comment('1-Active, 0-Inactive');
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
        Schema::dropIfExists('categories');
    }
}
