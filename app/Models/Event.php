<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'thumbnail_url',
        'description',
        'coordinate_lat',
        'coordinate_lng',
        'country',
        'city',
        'planing_time',
        'is_happened'
    ];

    public function category()
    {
        $this->hasOne(Category::class);
    }

    public function user()
    {
        $this->hasOne(User::class);
    }
}
