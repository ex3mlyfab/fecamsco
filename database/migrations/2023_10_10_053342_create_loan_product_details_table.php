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
        Schema::create('loan_product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_service_id')->constrained();
            $table->unsignedBigInteger('loan_product_id');
            $table->integer('quantity');
            $table->unsignedInteger('selling_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_product_details');
    }
};
