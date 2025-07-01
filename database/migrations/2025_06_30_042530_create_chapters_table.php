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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('desc')->nullable();
            $table->integer('order')->default(0);
            $table->integer('duration')->nullable(); // total time of all lessons
            $table->boolean('is_preview')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->text('review_msg')->nullable();
            $table->enum('status', ['draft', 'active', 'inactive'])->default('draft');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('course_id')->constrained('courses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
