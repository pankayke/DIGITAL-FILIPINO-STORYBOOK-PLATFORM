<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizQuestionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'prompt' => $this->prompt,
            'points' => $this->points,
            'sort_order' => $this->sort_order,
            'options' => QuizOptionResource::collection($this->whenLoaded('options')),
        ];
    }
}
