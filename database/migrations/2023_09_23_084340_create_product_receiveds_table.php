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
        Schema::create('product_receiveds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receive_order_id')->constrained();
            $table->foreignId('product_service_id')->constrained();
            $table->integer('initial_qty');
            $table->unsignedinteger('quantity_received');
            $table->unsignedinteger('cost_price');
            $table->unsignedinteger('selling_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_receiveds');
    }
};
