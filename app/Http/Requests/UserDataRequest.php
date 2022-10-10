<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UserDataRequest extends FormRequest
{
    public function rules()
    {
        return [
            'avatar'=>File::types(['jpeg','png'])->max(1024),
            'name'=>'required|string',
            'description'=>'required|string'
        ];
    }

    public function full()
    {
        return array_merge($this->all(),$this->allFiles());
    }
}
