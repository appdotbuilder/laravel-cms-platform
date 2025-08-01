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
            $table->text('description');
            $table->longText('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('duration_hours')->nullable()->comment('Estimated course duration in hours');
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->foreignId('instructor_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('is_published')->default(false);
            $table->integer('enrolled_count')->default(0);
            $table->decimal('rating', 3, 2)->default(0)->comment('Average rating out of 5');
            $table->timestamps();
            
            $table->index('slug');
            $table->index('is_published');
            $table->index('instructor_id');
            $table->index(['is_published', 'created_at']);
            $table->index('level');
            $table->index('price');
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