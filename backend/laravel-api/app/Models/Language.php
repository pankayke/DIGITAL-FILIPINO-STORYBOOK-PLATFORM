<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $fillable = [
        'name',
        'code',
        'native_name',
        'is_default',
    ];

    public function stories(): HasMany
    {
        return $this->hasMany(Story::class);
    }
}
