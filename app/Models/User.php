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
        'email_verified_at',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
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

    public function data(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserData::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
