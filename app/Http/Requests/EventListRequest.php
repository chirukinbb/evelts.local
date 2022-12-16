<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $search
 * @property int[] $points
 * @property int[] $dates
 * @property int[] $categories
 * @property int[] $authors
 */
class EventListRequest extends FormRequest
{
    public function rules()
    {
        return [
            'search' => 'string',
            'points' => 'array',
            'dates' => 'array',
            'categories' => 'array',
            'authors' => 'array'
        ];
    }
}
