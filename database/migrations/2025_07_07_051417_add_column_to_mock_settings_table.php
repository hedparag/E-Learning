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
        Schema::table('mock_settings', function (Blueprint $table) {
           $table->integer('min_question')->default(2);
           $table->integer('max_question')->default(50);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mock_settings', function (Blueprint $table) {
            //
        });
    }
};
