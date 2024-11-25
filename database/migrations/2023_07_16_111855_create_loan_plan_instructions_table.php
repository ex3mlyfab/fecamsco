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
        Schema::create('loan_plan_instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_plan_id');
            $table->unsignedInteger('charge_percentage')->nullable();
            $table->unsignedInteger('minimum_amount')->nullable();
            $table->unsignedInteger('maximum_amount')->nullable();
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
        Schema::dropIfExists('loan_plan_instructions');
    }
};
