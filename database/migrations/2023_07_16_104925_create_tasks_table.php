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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->unsignedInteger('amount')->nullable();
            $table->foreignId('uploaded_by');
            $table->foreignId('approved_by')->nullable();
            $table->foreignId('transaction_id')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=approved, 2=rejected');
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
        Schema::dropIfExists('tasks');
    }
};
