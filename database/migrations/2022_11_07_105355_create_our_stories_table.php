<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_stories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('banner_image')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status',1)->default(1)->comment('1-Active, 0-Inactive');
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('our_vision_image')->nullable();
            $table->text('our_vision_content')->nullable();
            $table->string('our_mission_image')->nullable();
            $table->text('our_mission_content')->nullable();
            $table->string('big_diamond_image')->nullable();
            $table->string('big_diamond_video')->nullable();


            $table->string('why_bonica_title')->nullable();
            $table->string('why_bonica_sub_title')->nullable();
            $table->string('why_bonica_image')->nullable();
            $table->string('why_bonica_authentic_title')->nullable();
            $table->text('why_bonica_authentic_description')->nullable();
            $table->string('why_bonica_economical_title')->nullable();
            $table->text('why_bonica_economical_description')->nullable();
            $table->string('why_bonica_protector_title')->nullable();
            $table->text('why_bonica_protector_description')->nullable();
            $table->string('why_bonica_maestros_title')->nullable();
            $table->text('why_bonica_maestros_description')->nullable();

            $table->string('our_commitment_title')->nullable();
            $table->string('our_commitment_first_icon')->nullable();
            $table->text('our_commitment_first_description')->nullable();
            $table->string('our_commitment_second_icon')->nullable();
            $table->text('our_commitment_second_description')->nullable();
            $table->string('our_commitment_third_icon')->nullable();
            $table->text('our_commitment_third_description')->nullable();
            $table->string('making_bonica_title')->nullable();
            $table->string('making_bonica_sub_title')->nullable();
            $table->string('making_bonica_diamond_seed_icon')->nullable();
            $table->string('making_bonica_diamond_seed_title')->nullable();
            $table->text('making_bonica_diamond_seed_description')->nullable();
            $table->string('making_bonica_heating_icon')->nullable();
            $table->string('making_bonica_heating_title')->nullable();
            $table->text('making_bonica_heating_description')->nullable();
            $table->string('making_bonica_plasma_icon')->nullable();
            $table->string('making_bonica_plasma_title')->nullable();
            $table->text('making_bonica_plasma_description')->nullable();
            $table->string('making_bonica_all_diamonds_icon')->nullable();
            $table->string('making_bonica_all_diamonds_title')->nullable();
            $table->text('making_bonica_all_diamonds_description')->nullable();


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
        Schema::dropIfExists('our_stories');
    }
}
