<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoryPageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'page_number' => $this->page_number,
            'title' => $this->title,
            'content' => $this->content,
            'illustration_url' => $this->illustration_url,
            'narration_audio_url' => $this->narration_audio_url,
        ];
    }
}
