<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $attributes = [
        'event_id',
        'photo_url'
    ];

    public function photo()
    {
        return $this->belongsTo(Event::class);
    }
}
