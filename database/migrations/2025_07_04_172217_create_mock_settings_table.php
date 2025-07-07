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
        Schema::create('mock_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('total_questions');
            $table->integer('total_marks');
            $table->integer('duration');
            $table->enum('question_type',['MCQ','Fill in the Blanks','True/False']);
            $table->text('instructions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mock_settings');
    }
};
