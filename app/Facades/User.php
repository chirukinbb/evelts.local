<?php

namespace App\Facades;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static UserResource auth(array $attrs)
 * @method static updateData(array $attrs)
 * @method static confirm(string $email,string $slug)
 * @method static bool changePassword(array $attrs)
 * @method static bool changeEmailRequest(array $attrs)
 * @method static bool changeEmail(string $code)
 */
class User  extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'user';
    }
}
