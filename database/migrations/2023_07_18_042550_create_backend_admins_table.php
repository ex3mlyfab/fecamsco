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
        Schema::create('backend_admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('executive_id');
            $table->foreignId('user_id');
            $table->date('tenure_starts');
            $table->date('tenure_ends')->nullable();
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
        Schema::dropIfExists('backend_admins');
    }
};

