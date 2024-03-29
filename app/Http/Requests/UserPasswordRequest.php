<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'password'=>'required|string',
            'new_password'=>'required|string'
        ];
    }
}
