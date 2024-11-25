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
        Schema::create('awaiting_mandates', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('awaiting_mandates');
    }
};
