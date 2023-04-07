<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',150);
            $table->string('last_name',150)->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('email',255)->unique();
            $table->string('password',100)->nullable();
            $table->boolean('status',1)->default(true)->comment('1-Active, 0-Inactive');
            $table->string('phone_number',20)->nullable();
            $table->string('street_address')->nullable();
            $table->string('street_address2')->nullable();
            $table->string('city',150)->nullable();
            $table->string('pincode',20)->nullable();
            $table->string('state',150)->nullable();
            $table->string('country',150)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('confirmation_code')->nullable();
            $table->integer('confirmed')->default(0);
            $table->tinyInteger('email_verified')->default(0);
            $table->string('social_id')->nullable();
            $table->string('social_type')->nullable();
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
        Schema::dropIfExists('users');
    }
}
