<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_guides', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('banner_image')->nullable();
            $table->boolean('status',1)->default(1)->comment('1-Active, 0-Inactive');
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->string('page_title')->nullable();

            $table->string('rings_title')->nullable();
            $table->text('rings_content1')->nullable();
            $table->string('measurement_image')->nullable();
            $table->string('diamond_skeleton_image')->nullable();
            $table->string('step1_image')->nullable();
            $table->string('step2_image')->nullable();
            $table->text('rings_content2')->nullable();

            $table->string('bracelets_title')->nullable();
            $table->text('bracelets_content1')->nullable();
            $table->string('diameter_skeleton_image')->nullable();
            $table->string('bracelets_image')->nullable();
            $table->text('bracelets_content2')->nullable();

            $table->string('necklaces_image')->nullable();
            $table->text('necklaces_content')->nullable();



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
        Schema::dropIfExists('size_guides');
    }
}
