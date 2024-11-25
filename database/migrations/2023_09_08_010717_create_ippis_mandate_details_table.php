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
        Schema::create('ippis_mandate_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ippis_mandate_id')->constrained();
            $table->unsignedBigInteger('deduction_amount')->nullable();
            $table->string('employee_name');
            $table->string('employee_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ippis_mandate_details');
    }
};
