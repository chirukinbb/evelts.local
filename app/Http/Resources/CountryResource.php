<?php

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * @var Country
     */
    public $resource;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'iso' => $this->resource->iso,
            'name' => $this->resource->name
        ];
    }
}
