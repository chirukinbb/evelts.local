<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class EventColllection extends JsonResource
{
    /**
     * @var Event
     */
    public $resource;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'thumbnail_url' => $this->resource->thumbnail_url,
            'country' => $this->resource->country,
            'city' => $this->resource->city,
            'category' => CategoryResource::make($this->resource->category),
            'author' => UserResource::make($this->resource->user)
        ];
    }
}
