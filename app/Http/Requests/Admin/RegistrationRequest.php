<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{

    public function rules()
    {
        return ['email' => 'required|email|unique:users'];
    }
}
