<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,

            'country_id' => $this->country_id,
            'country_name' => optional($this->country)->name,

            'language_id' => $this->language_id,
            'language_name' => optional($this->language)->name,

            'category_id' => $this->category_id,
            'category_name' => optional($this->category)->name,
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
