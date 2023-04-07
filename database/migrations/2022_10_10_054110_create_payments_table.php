<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onUpdate('CASCADE')->onDelete('cascade');
            $table->integer('user_id')->default(0);
            $table->string('transaction_id')->nullable()->comment('Payment Id');
            $table->string('generated_order_id')->nullable()->comment('Razorpay Order Id');
            $table->double('amount');
            $table->string('currency')->nullable();
            $table->decimal('amount_in_INR', 10, 2)->nullable();
            $table->string('status')->nullable();
            $table->string('method')->nullable();
            $table->string('amount_refunded')->nullable();
            $table->string('bank')->nullable();
            $table->string('wallet')->nullable();
            $table->string('entity')->nullable();
            $table->string('refund_Date')->nullable();
            $table->string('bank_transaction_id')->nullable();
            $table->string('upi_transaction_id')->nullable();
            $table->string('refund_id')->nullable();
            $table->string('ip_address')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
