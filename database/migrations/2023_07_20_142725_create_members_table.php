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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('department', 60)->nullable();
            $table->string('location', 50)->nullable();
            $table->mediumText('residential_address')->nullable();
            $table->string('telephone')->nullable();
            $table->mediumText('permanent_address')->nullable();
            $table->string('next_of_kin')->nullable();
            $table->string('nok_relationship')->nullable();
            $table->mediumText('nok_address')->nullable();
            $table->string('file_no')->nullable();
            $table->string('ippis_no', 100)->unique();
            $table->string('rank', 40)->nullable();
            $table->string('grade', 20)->nullable();
            $table->unsignedInteger('deduction_amount')->nullable();
            $table->date('effective_date')->nullable();
            $table->boolean('declaration')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->foreignId('approved_by')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('avatar')->nullable();
            $table->mediumText('official_remark')->nullable();
            $table->string('membership_id')->nullable();
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
        Schema::dropIfExists('members');
    }
};
