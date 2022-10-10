<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * @var User
     */
    public $resource;

    public function toArray($request)
    {
        return [
            'user'=>UserResource::make($this->resource)->toArray($request),
            'token'=>$this->resource->createToken('user')->plainTextToken
        ];
    }
}
