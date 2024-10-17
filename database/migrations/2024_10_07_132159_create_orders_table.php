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
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->json('billing_address');
            $table->json('shipping_address')->nullable();
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->string('payment_method');
            $table->string('shipping_method');
            $table->enum('status', ['new', 'processing', 'shipped', 'delivered', 'canceled'])->default('new');
            $table->string('currency')->nullable();
            $table->decimal('shiping_amount', 10, 2)->nullable();
            $table->text('notes');
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
