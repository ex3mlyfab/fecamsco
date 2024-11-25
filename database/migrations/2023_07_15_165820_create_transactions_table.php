<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approved_by')->constrained('users');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->unsignedBigInteger('amount')->nullable();
            $table->string('trx_type', 40);
            $table->date('uploaded_date')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('status',40)->nullable();
            $table->morphs('transactionable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
