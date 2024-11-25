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
        Schema::create('bank_mandates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->constrained();
            $table->string('batch_id');
            $table->unsignedBigInteger('total_amount')->nullable();
            $table->tinyInteger('mandate_status')->default(0)->comment('0=pending,1=running,2=paid,3=rejected');
            $table->foreignId('prepared_by')->constrained('users');
            $table->unsignedBigInteger('approved_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_mandates');
    }
};
