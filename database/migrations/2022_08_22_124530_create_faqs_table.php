<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cate_id')->constrained('category_faqs')->onUpdate('CASCADE')->onDelete('cascade');
            $table->string('question');
            $table->string('slug')->nullable()->unique();
            $table->text('answer');
            $table->boolean('status',1)->default(1)->comment('1-Active, 0-Inactive');
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
        Schema::dropIfExists('faqs');
    }
}
