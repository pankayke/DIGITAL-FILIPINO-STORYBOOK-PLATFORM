<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'passing_score' => $this->passing_score,
            'time_limit_seconds' => $this->time_limit_seconds,
            'questions' => QuizQuestionResource::collection($this->whenLoaded('questions')),
        ];
    }
}
