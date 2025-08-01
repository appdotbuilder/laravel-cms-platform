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
            $table->string('slug');
            $table->longText('content');
            $table->string('video_url')->nullable();
            $table->integer('duration_minutes')->nullable()->comment('Lesson duration in minutes');
            $table->integer('order')->default(0)->comment('Order within course');
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_free')->default(false)->comment('Free preview lesson');
            $table->timestamps();
            
            $table->unique(['course_id', 'slug']);
            $table->index('course_id');
            $table->index('is_published');
            $table->index(['course_id', 'order']);
            $table->index('is_free');
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