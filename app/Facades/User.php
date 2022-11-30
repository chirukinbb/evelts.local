<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\User login(string $email)
 * @method static array registration(string $email, string $password = '')
 * @method static updateData(array $attrs, int $id = 0)
 * @method static updateName(string $name)
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
