<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\File;

/**
 * @property UploadedFile $photo
 **/
class PhotoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'photo' => [
                File::types(['jpeg', 'png'])->max(1024)
            ],
        ];
    }
}
