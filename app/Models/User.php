<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const GOOGLE_AUTH = 0;
    const FACEBOOK_AUTH = 1;
    const DEFAULT_AUTH = 2;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'google_token',
        'facebook_token',
        'email_verified_at',
        'remember_token',
        'description'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google_token',
        'facebook_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function setGoogleTokenAttribute($value)
    {
        $this->attributes['google_token'] = \Hash::make($value);
    }

    public function setFacebookTokenAttribute($value)
    {
        $this->attributes['facebook_token'] = \Hash::make($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value  ?? \Arr::first(explode('@',$this->attributes['email']));
    }
}
