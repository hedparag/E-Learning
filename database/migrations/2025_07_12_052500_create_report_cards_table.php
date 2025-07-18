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
        Schema::create('report_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('student_classes')->onDelete('cascade');
            $table->string('name');
            $table->string('roll_number');

            $table->integer('subject');
            $table->integer('total_marks');
            $table->integer('obtained_marks');
            $table->integer('percentage');
            $table->string('grade');
            $table->string('overall_grade');
            $table->string('result_status'); // Pass / Fail
            $table->timestamp('issued_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_cards');
    }
};
