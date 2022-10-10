<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email'=>'require|string',
            'password'=>'require|string',
            'type'=>'require|integer'
        ];
    }
}
