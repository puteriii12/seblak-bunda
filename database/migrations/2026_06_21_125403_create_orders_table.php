<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->integer('spicy_level')->default(0);
            $table->enum('order_type', ['dine-in', 'take-away']);
            $table->enum('payment_method', ['qris', 'cash']);
            $table->text('note')->nullable();
            $table->enum('status', ['pending_payment', 'confirmed', 'processing', 'completed', 'cancelled'])->default('confirmed');
            $table->decimal('total', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};