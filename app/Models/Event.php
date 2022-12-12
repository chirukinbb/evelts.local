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
        'country_id',
        'point_id',
        'planing_time',
        'is_happened',
        'slots',
        'address'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function point()
    {
        return $this->belongsTo(Point::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function gallery()
    {
        return $this->hasMany(Photo::class);
    }
}
