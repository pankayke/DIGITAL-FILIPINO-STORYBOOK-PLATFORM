<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Story extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image_url',
        'author_id',
        'category_id',
        'language_id',
        'min_age',
        'max_age',
        'estimated_reading_minutes',
        'difficulty',
        'publication_status',
        'is_featured',
        'read_count',
        'average_rating',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(StoryCategory::class, 'category_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(StoryPage::class)->orderBy('page_number');
    }

    public function vocabularyWords(): HasMany
    {
        return $this->hasMany(VocabularyWord::class);
    }

    public function quiz(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class);
    }
}
