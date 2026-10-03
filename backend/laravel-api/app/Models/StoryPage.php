<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoryPage extends Model
{
    protected $fillable = [
        'story_id',
        'page_number',
        'title',
        'content',
        'illustration_url',
        'narration_audio_url',
    ];

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }
}
