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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            //Verbose Syntax
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('price_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->string('arp_no')->nullable();
            $table->date('order_date')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('total_kg', 8, 2);
            $table->timestamps();

            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
