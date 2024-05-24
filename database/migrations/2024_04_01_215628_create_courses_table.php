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
            $table->string('title');
            $table->string('slug')->unique();
            $table->timestamp('date');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('imageUrl')->nullable();
            $table->string('level')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->text('meta')->nullable();

            $table->string('category_slug')->nullable();
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('category_slug')->references('slug')->on('categories')->nullOnDelete();
            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete();
            $table->timestamps();
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
