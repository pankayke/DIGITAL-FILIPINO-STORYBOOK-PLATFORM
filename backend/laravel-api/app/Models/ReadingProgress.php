<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReadingProgress extends Model
{
    protected $fillable = [
        'user_id',
        'child_profile_id',
        'story_id',
        'last_page_number',
        'completion_percentage',
        'seconds_read',
        'is_completed',
        'quiz_score',
        'vocabulary_mastery',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function childProfile(): BelongsTo
    {
        return $this->belongsTo(ChildProfile::class);
    }

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }
}
