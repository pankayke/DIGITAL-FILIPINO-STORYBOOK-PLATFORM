<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('child_profile_id')->nullable()->constrained('child_profiles')->cascadeOnDelete();
            $table->foreignId('story_id')->constrained('stories')->cascadeOnDelete();
            $table->unsignedInteger('last_page_number')->default(1);
            $table->unsignedTinyInteger('completion_percentage')->default(0);
            $table->unsignedInteger('seconds_read')->default(0);
            $table->boolean('is_completed')->default(false);
            $table->unsignedTinyInteger('quiz_score')->default(0);
            $table->unsignedTinyInteger('vocabulary_mastery')->default(0);
            $table->timestamps();
            $table->unique(['user_id', 'story_id', 'child_profile_id'], 'reading_progress_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_progress');
    }
};
