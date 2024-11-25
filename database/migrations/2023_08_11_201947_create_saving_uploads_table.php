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
        Schema::create('saving_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saving_upload_detail_id')->constrained();
            $table->unsignedBigInteger('deduction_amount')->nullable();
            $table->string('employee_name');
            $table->string('employee_number');
            $table->tinyInteger('saving_linked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_uploads');
    }
};
