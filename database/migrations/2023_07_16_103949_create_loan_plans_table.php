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
        //now works as loan application form
        Schema::create('loan_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('approved_by')->nullable();
            $table->string('name');
            $table->unsignedInteger('minimum_amount')->nullable();
            $table->unsignedInteger('maximum_amount')->nullable();
            $table->mediumInteger('total_installments');
            $table->text('instructions')->nullable();
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
        Schema::dropIfExists('loan_plans');
    }
};
