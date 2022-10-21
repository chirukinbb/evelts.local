<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function full()
    {
        return array_merge($this->all(), $this->allFiles());
    }
}
