<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\File;

/**
 * @property string $title
 * @property string $description
 * @property UploadedFile $thumbnail
 * @property string $address
 * @property int $category_id
 * @property int $slots
 * @property int|null $user_id
 * @property string[] $tags
 * @property int $planing_time
 */
class EventRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => [
                File::types(['jpeg', 'png'])->max(1024)
            ],
            'address' => 'required|string',
            'category_id' => 'required|numeric',
            'user_id' => 'numeric',
            'slots' => 'numeric',
            'tags' => 'array',
            'planing_time' => 'required|numeric'
        ];
    }
}
