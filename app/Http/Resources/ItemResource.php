<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'description' => $this->description,
            'location' => $this->location,
            'post_type' => $this->post_type,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'user'     => new UserResource($this->whenLoaded('user')),
            'posted_at' => $this->created_at->diffForHumans(),
            'itemImages'   => ItemImageResource::collection($this->whenLoaded('itemImages')),
        ];
    }
}
