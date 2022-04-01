<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'slug' => $this->slug,
            'attributes' => [
                'title' => $this->title,
                'content' => $this->content,
                'picture' => $this->thumbnail,
                'created_at' => $this->created_at->diffForHumans(),
            ]
        ];
    }
}

