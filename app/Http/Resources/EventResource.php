<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * @var Event
     */
    public $resource;
    public static $wrap = false;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'thumbnail_url' => $this->resource->thumbnail_url,
            'description' => $this->resource->description,
            'coordinate_lat' => $this->resource->coordinate_lat,
            'coordinate_lng' => $this->resource->coordinate_lng,
            'category' => CategoryResource::make($this->resource->category),
            'author' => UserResource::make($this->resource->user)
        ];
    }
}
