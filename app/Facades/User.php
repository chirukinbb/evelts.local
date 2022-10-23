<?php

namespace App\Facades;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static UserResource auth(array $attrs)
 * @method static updateData(array $attrs)
 * @method static confirm(string $email, string $slug)
 * @method static bool changePassword(array $attrs)
 * @method static bool changeEmailRequest(array $attrs)
 * @method static bool changeEmail(string $code)
 * @method static bool following(int $userId)
 * @method static bool acceptFriendship(int $userId)
 * @method static bool removeFromFriend(int $userId)
 * @method static bool unfollowing(int $userId)
 */
class User extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'user';
    }
}
