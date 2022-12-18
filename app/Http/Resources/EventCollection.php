<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class EventCollection extends JsonResource
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
            'country' => CountryResource::make($this->resource->country),
            'point' => PointResource::make($this->resource->point),
            'category' => CategoryResource::make($this->resource->category),
            'author' => UserResource::make($this->resource->author),
            'tags' => TagResource::collection($this->resource->tags)
        ];
    }
}
