<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('story_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('bio')->nullable();
            $table->string('photo_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('cover_image_url')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('authors')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('story_categories')->nullOnDelete();
            $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();
            $table->unsignedTinyInteger('min_age')->default(3);
            $table->unsignedTinyInteger('max_age')->default(12);
            $table->unsignedTinyInteger('estimated_reading_minutes')->default(5);
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
            $table->enum('publication_status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('read_count')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('story_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained('stories')->cascadeOnDelete();
            $table->unsignedInteger('page_number');
            $table->string('title')->nullable();
            $table->longText('content');
            $table->string('illustration_url')->nullable();
            $table->string('narration_audio_url')->nullable();
            $table->timestamps();
            $table->unique(['story_id', 'page_number']);
        });

        Schema::create('vocabulary_words', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained('stories')->cascadeOnDelete();
            $table->string('word');
            $table->string('translation');
            $table->text('definition');
            $table->text('example_sentence')->nullable();
            $table->enum('difficulty_level', ['easy', 'medium', 'hard'])->default('easy');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vocabulary_words');
        Schema::dropIfExists('story_pages');
        Schema::dropIfExists('stories');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('story_categories');
    }
};
