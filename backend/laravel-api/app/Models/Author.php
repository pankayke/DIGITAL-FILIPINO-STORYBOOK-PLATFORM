<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    protected $fillable = [
        'name',
        'bio',
        'photo_url',
        'is_featured',
    ];

    public function stories(): HasMany
    {
        return $this->hasMany(Story::class);
    }
}
