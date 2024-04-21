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
        Schema::create('categories', function (Blueprint $table) {
            $table->string('slug', 191)->unique()->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('imageUrl')->nullable();
            $table->string('parent_slug', 191)->nullable();
            $table->timestamps();

            $table->foreign('parent_slug')->references('slug')->on('categories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
