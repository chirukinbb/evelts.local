<?php

namespace App\Http\Resources;

use App\Models\Point;
use Illuminate\Http\Resources\Json\JsonResource;

class PointResource extends JsonResource
{
    /**
     * @var Point
     */
    public $resource;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name
        ];
    }
}
