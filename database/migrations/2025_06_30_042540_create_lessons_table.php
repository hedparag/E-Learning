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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc')->nullable();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('chapter_id')->constrained('chapters')->onDelete('cascade');
            $table->enum('storage', ['upload', 'external_links', 'vimeo', 'youtube']);
            $table->string('path');
            $table->integer('duration')->nullable(); // in seconds
            $table->enum('file_type', ['video', 'audio', 'doc', 'file']);
            $table->integer('order')->default(0);
            $table->boolean('downloadable')->default(false);



            $table->string('thumbnail')->nullable();

            $table->boolean('is_approved')->default(false);
            $table->text('review_msg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
