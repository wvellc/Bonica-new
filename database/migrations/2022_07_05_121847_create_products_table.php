<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->nullable()->constrained('categories')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('sub_cat_id')->nullable()->constrained('categories')->onUpdate('CASCADE')->onDelete('cascade');
            $table->foreignId('labour_type')->nullable()->constrained('labours')->onUpdate('CASCADE')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->boolean('is_sales', 1)->default(0)->comment("1-it's Sales Category");
            $table->decimal('sales_price', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('other_expenses', 10, 2)->nullable();
            $table->boolean('is_all_include_price', 1)->default(0)->comment('1-Yes, 0-No');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('sku', 90)->nullable();
            $table->boolean('gender', 1)->default(0)->comment('1-Men, 2-Women');
            $table->string('made_in', 90)->nullable();
            $table->string('metal', 90)->nullable();
            $table->double('product_size', 8, 2)->nullable();
            $table->string('resizable', 60)->nullable();
            $table->double('diamonds', 8, 2)->nullable()->comment(' Diamonds (Carats)');
            $table->string('stone', 120)->nullable();
            $table->string('color', 120)->nullable();
            $table->string('clarity', 120)->nullable();
            $table->string('igi_certified')->nullable();
            $table->string('igi_certified_text')->nullable();
            $table->string('free_delivery')->nullable();
            $table->double('gold_weight', 8, 2)->nullable();
            $table->double('diamond_weight', 8, 2)->nullable();
            $table->double('net_weight', 8, 2)->nullable();
            $table->double('grosswt', 8, 2)->nullable();
            $table->json('multiplyby')->nullable()->comment('price calcualtion for country');
            $table->integer('diamond_pcs')->default(0);
            $table->boolean('recommended', 1)->default(0)->comment('1-Yes, 0-No');
            $table->string('recommended_hover_image')->nullable();
            $table->boolean('status', 1)->default(1)->comment('1-Active, 0-Inactive');
            $table->boolean('is_solitaire', 1)->default(0)->comment('1-Yes, 0-No');
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
        Schema::dropIfExists('products');
    }
}
