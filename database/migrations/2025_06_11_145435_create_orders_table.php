<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //trancation_time
            $table->string('transaction_number')->unique();
            //total_price
            $table->decimal('total_price', 10, 2);
            //total item
            $table->integer('total_item')->default(0); //kasir_id
            $table->unsignedBigInteger('cashier_id')->nullable();
            $table->foreign('cashier_id')->references('id')->on('users')->onDelete('set null');
            //payment_method
            $table->string('payment_method')->default('cash'); // cash, credit_card, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
