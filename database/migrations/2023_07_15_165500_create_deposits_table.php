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
        //saves all contributions monthly
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('description');
            $table->foreignId('saving_upload_id');
            $table->unsignedBigInteger('amount')->nullable();
            $table->unsignedBigInteger('initial_balance')->nullable();
            $table->foreignId('approved_by')->nullable(); //date of approval
            $table->date('approval_date')->nullable();
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
        Schema::dropIfExists('deposits');
    }
};
