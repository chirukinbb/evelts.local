<?php

namespace App\Facades;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static UserResource auth(array $attrs)
 * @method static updateData(array $attrs)
 */
class User  extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'user';
    }
}
