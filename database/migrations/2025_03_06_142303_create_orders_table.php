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
            //Verbose Syntax
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            //Short-hand Syntax
            $table->foreignId('price_id')->constrained('prices')->onDelete('cascade');
            $table->decimal('total_kg', 8, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('arp_no')->nullable();
            $table->integer('status');
            $table->text('description')->nullable();
            $table->date('order_date')->nullable();
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
