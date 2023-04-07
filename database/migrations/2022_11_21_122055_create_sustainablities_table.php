<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSustainablitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sustainablities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('banner_image')->nullable();
            $table->boolean('status',1)->default(1)->comment('1-Active, 0-Inactive');
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->string('sustainability_title')->nullable();
            $table->string('sustainability_sub_title')->nullable();

            $table->string('sustainability_image')->nullable();
            $table->text('sustainability_content')->nullable();

            $table->string('mining_free_process_title')->nullable();
            $table->string('mining_free_process_image')->nullable();
            $table->text('mining_free_process_content')->nullable();

            $table->string('mining_free_title')->nullable();
            $table->string('mining_free_sub_title')->nullable();
            $table->string('mining_free_image_1')->nullable();
            $table->string('mining_free_image_2')->nullable();
            $table->string('mining_free_image_3')->nullable();

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
        Schema::dropIfExists('sustainablities');
    }
}
