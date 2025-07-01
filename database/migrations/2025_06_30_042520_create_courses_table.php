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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')->constrained('users');
            $table->foreignId('subject_id')->constrained('add_subjects');
            $table->foreignId('class_id')->constrained('student_classes')->onDelete('cascade');

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('desc')->nullable();
            $table->string('duration')->nullable();
            $table->string('thumbnail')->nullable();

            $table->string('demo_video_source')->nullable();
             $table->enum('demo_video_storage',['upload','youtube','vimeo','external_link'])->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('qna')->default(false);

            $table->boolean('is_approved')->default(false);
            $table->text('msg_for_reviewer')->nullable();

            $table->enum('status', ['draft', 'active', 'archived'])->default('draft');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
