<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * @var Category
     */
    public $resource;
    public static $wrap = false;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title
        ];
    }
}
