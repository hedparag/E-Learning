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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
             $table->string('title');
            $table->text('body'); // Use `body` as the message content
            $table->enum('target_type', ['all','student','class'])->default('all');
            $table->unsignedBigInteger('target_id')->nullable(); // e.g., class_id
            $table->string('attachment')->nullable(); // File path
            $table->boolean('is_active')->default(true);
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
