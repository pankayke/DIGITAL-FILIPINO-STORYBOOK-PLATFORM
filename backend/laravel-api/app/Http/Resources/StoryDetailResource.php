<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoryDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'cover_image_url' => $this->cover_image_url,
            'author' => new AuthorResource($this->whenLoaded('author')),
            'category' => new StoryCategoryResource($this->whenLoaded('category')),
            'language' => new LanguageResource($this->whenLoaded('language')),
            'pages' => StoryPageResource::collection($this->whenLoaded('pages')),
            'vocabulary_words' => VocabularyWordResource::collection($this->whenLoaded('vocabularyWords')),
            'quiz' => QuizResource::collection($this->whenLoaded('quiz')),
            'estimated_reading_minutes' => $this->estimated_reading_minutes,
            'difficulty' => $this->difficulty,
            'publication_status' => $this->publication_status,
        ];
    }
}
