<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonica5bs3sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonica5bs3s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('banner_image')->nullable();
            $table->boolean('status',1)->default(1)->comment('1-Active, 0-Inactive');
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('title')->nullable();
            $table->string('big_image')->nullable();
            $table->string('image_1')->nullable();
            $table->string('title_1')->nullable();
            $table->text('content_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('title_2')->nullable();
            $table->text('content_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('title_3')->nullable();
            $table->text('content_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('title_4')->nullable();
            $table->text('content_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('title_5')->nullable();
            $table->text('content_5')->nullable();
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
        Schema::dropIfExists('bonica5bs3s');
    }
}
