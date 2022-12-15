<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $email
 * @property string $password
 * @property string $token
 */
class AuthRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'email',
            'password' => 'string',
            'token' => 'string'
        ];
    }
}
