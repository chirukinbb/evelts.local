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
            'category' => CategoryResource::make($this->resource->category)->toArray($request),
            'author' => UserResource::make($this->resource->author)->toArray($request),
            'slots'=>$this->resource->slots,
            'tags'=>TagResource::collection($this->resource->tags)->toArray($request),
            'gallery',
            'comments',
            'planing_time'=>$this->resource->planing_time
        ];
    }
}
