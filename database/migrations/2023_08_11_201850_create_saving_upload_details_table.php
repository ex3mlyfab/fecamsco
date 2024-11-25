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
        Schema::create('saving_upload_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uploaded_by')->constrained('users');
            $table->string('uploaded_file');
            $table->string('ministry_name');
            $table->string('element_name');
            $table->date('deduction_period');
            $table->unsignedBigInteger('total_amount')->nullable();
            $table->foreignId('approved_by')->nullable();
            $table->tinyInteger('upload_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_upload_details');
    }
};
