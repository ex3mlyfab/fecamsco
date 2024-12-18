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
        Schema::create('receive_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receive_order_id');
            $table->foreignId('product_service_id');
            $table->unsignedInteger('price')->nullable();
            $table->integer('quantity');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('receive_order_details');
    }
};
