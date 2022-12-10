<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property string $title
 * @property string $description
 * @property UploadedFile $thumbnail
 * @property string $address
 * @property int $category_id
 * @property int $slots
 * @property int|null $user_id
 * @property string[] $tags
 */
class EventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'=>'required|string',
            'description'=>'required|string',
            'thumbnail'=>'required|string',
            'address'=>'required|string',
            'category_id'=>'required|number',
            'user_id'=>'number',
            'slots'=>'required|number',
            'tags'=>'array',
        ];
    }
}
