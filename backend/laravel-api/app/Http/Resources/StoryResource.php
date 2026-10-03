<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'cover_image_url' => $this->cover_image_url,
            'author' => $this->author?->name,
            'category' => $this->category?->name,
            'language' => $this->language?->code,
            'difficulty' => $this->difficulty,
            'min_age' => $this->min_age,
            'max_age' => $this->max_age,
            'estimated_reading_minutes' => $this->estimated_reading_minutes,
            'publication_status' => $this->publication_status,
            'is_featured' => (bool) $this->is_featured,
            'read_count' => $this->read_count,
            'average_rating' => (float) $this->average_rating,
        ];
    }
}
