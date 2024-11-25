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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedInteger('amount')->nullable();
            $table->tinyInteger('loan_type');
            $table->tinyInteger('status')->comment('0=pending,1=running,2=paid,3=rejected');
            $table->string('loan_form')->nullable(); //upload of loan form after completion by client.
            $table->mediumInteger('given_installment');// current loan installment figures
            $table->boolean('is_disbursed')->default(false);
            $table->mediumInteger('total_installments');
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
        Schema::dropIfExists('loans');
    }
};
