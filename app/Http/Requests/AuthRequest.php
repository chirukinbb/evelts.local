<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'email',
            'password' => 'string',
            'token' => 'string',
            'type' => 'integer'
        ];
    }
}
