<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VocabularyWordResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'word' => $this->word,
            'translation' => $this->translation,
            'definition' => $this->definition,
            'example_sentence' => $this->example_sentence,
            'difficulty_level' => $this->difficulty_level,
        ];
    }
}
