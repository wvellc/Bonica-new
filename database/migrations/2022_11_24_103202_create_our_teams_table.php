<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->boolean('status',1)->default(1)->comment('1-Active, 0-Inactive');
            $table->string('title')->nullable();
            $table->string('member1_name')->nullable();
            $table->string('member1_image')->nullable();
            $table->text('member1_info')->nullable();
            $table->string('member2_name')->nullable();
            $table->string('member2_image')->nullable();
            $table->text('member2_info')->nullable();
            $table->string('team_title')->nullable();
            $table->string('milestone_title')->nullable();
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
        Schema::dropIfExists('our_teams');
    }
}
