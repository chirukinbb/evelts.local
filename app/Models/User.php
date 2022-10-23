<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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
        $this->attributes['name'] = $value ?? \Arr::first(explode('@', $this->attributes['email']));
    }

    public function friends()
    {
        $firstUsers = $this->hasMany('relations', 'first_user_id', 'id')
            ->whereNotNull('approve')->get();
        $secondUsers = $this->hasMany('relations', 'second_user_id', 'id')
            ->whereNotNull('approve')->get();

        return [];
    }

    public function followers()
    {
        return $this->hasMany('relations', 'first_user_id', 'id')
            ->whereNull('approve')->get();
    }

    public function followedOn()
    {
        return $this->hasMany('relations', 'first_user_id', 'id')
            ->whereNull('approve')->get();
    }

    public function subscribeOnEvents()
    {
        return $this->belongsToMany(Event::class);
    }
}
