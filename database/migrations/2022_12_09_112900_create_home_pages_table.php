<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();

            $table->integer('banner_type')->default(0)->comment('0 = Image , 1 = Video');
            $table->string('video')->nullable();
            $table->string('video_title')->nullable();
            $table->string('video_content')->nullable();
            $table->string('video_link')->nullable();
            $table->string('video_path')->nullable();
            $table->boolean('status', 1)->default(1)->comment('1-Active, 0-Inactive');

            $table->string('top_section_image1')->nullable();
            $table->string('top_section_image2')->nullable();
            $table->string('top_section_title')->nullable();
            $table->string('top_section_content')->nullable();
            $table->string('top_section_link')->nullable();

            $table->string('shringaar_title')->nullable();
            $table->string('shringaar_sub_title')->nullable();
            $table->string('shringaar_image1_title')->nullable();
            $table->string('shringaar_image1')->nullable();
            $table->string('shringaar_image1_link')->nullable();

            $table->string('shringaar_image2_title')->nullable();
            $table->string('shringaar_image2')->nullable();
            $table->string('shringaar_image2_link')->nullable();

            $table->string('shringaar_image3_title')->nullable();
            $table->string('shringaar_image3')->nullable();
            $table->string('shringaar_image3_link')->nullable();

            $table->string('shringaar_image4_title')->nullable();
            $table->string('shringaar_image4')->nullable();
            $table->string('shringaar_image4_link')->nullable();

            $table->string('shringaar_image5_title')->nullable();
            $table->string('shringaar_image5')->nullable();
            $table->string('shringaar_image5_link')->nullable();

            $table->string('shringaar_image6_title')->nullable();
            $table->string('shringaar_image6')->nullable();
            $table->string('shringaar_image6_link')->nullable();

            $table->string('catalog_title')->nullable();
            $table->string('catalog_sub_title')->nullable();
            $table->string('catalog_category_ids')->nullable();

            $table->string('bonica_jewels_title')->nullable();
            $table->string('bonica_jewels_sub_title')->nullable();

            $table->string('bonica_jewels_icon1')->nullable();
            $table->string('bonica_jewels_icon1_title')->nullable();
            $table->string('bonica_jewels_icon1_content')->nullable();

            $table->string('bonica_jewels_icon2')->nullable();
            $table->string('bonica_jewels_icon2_title')->nullable();
            $table->string('bonica_jewels_icon2_content')->nullable();

            $table->string('bonica_jewels_icon3')->nullable();
            $table->string('bonica_jewels_icon3_title')->nullable();
            $table->string('bonica_jewels_icon3_content')->nullable();

            $table->string('bonica_jewels_icon4')->nullable();
            $table->string('bonica_jewels_icon4_title')->nullable();
            $table->string('bonica_jewels_icon4_content')->nullable();

            $table->string('recommended_title')->nullable();
            $table->string('recommended_sub_title')->nullable();

            $table->string('about_bonica_title')->nullable();
            $table->string('about_bonica_content')->nullable();
            $table->string('about_bonica_bg_image')->nullable();
            $table->string('about_bonica_link')->nullable();

            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

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
        Schema::dropIfExists('home_pages');
    }
}
