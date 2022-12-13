<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * @var Comment
     */
    public $resource;

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'parent_comment_id' => $this->resource->parent_comment_id,
            'author' => UserResource::make($this->resource->author)->toArray($request),
            'content' => $this->resource->content
        ];
    }
}
