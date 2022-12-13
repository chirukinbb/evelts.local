<?php

namespace App\Http\Resources;

use App\Models\Photo;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    /**
     * @var Photo
     */
    public $resource;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'url' => $this->resource->photo_url
        ];
    }
}
