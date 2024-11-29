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
        Schema::table('executives', function (Blueprint $table) {
            //
        $table->foreignId('user_id')->constrained('users');
        $table->string('position');
        $table->string('avatar')->nullable();
        $table->smallInteger('status')->default(0);
        $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('executives', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
            $table->dropColumn('position');
            $table->dropColumn('avatar');
            $table->dropColumn('status');
            $table->string('name');
        });
    }
};
