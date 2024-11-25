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
        Schema::create('bank_mandate_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_mandate_id')->constrained();
            $table->morphs('mandateable');
            $table->unsignedBigInteger('amount');
            $table->string('narration');
            $table->string('account_name');
            $table->string('account_number');
            $table->string('bank_name');
            $table->tinyInteger('status')->default(0)->comment('0=pending, 1=downloaded,2= disbursed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_mandate_details');
    }
};
