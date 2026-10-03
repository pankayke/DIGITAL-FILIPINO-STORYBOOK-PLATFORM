<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VocabularyWord extends Model
{
    protected $fillable = [
        'story_id',
        'word',
        'translation',
        'definition',
        'example_sentence',
        'difficulty_level',
    ];

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }
}
