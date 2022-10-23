<?php

// @formatter:off

/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models {
    /**
     * App\Models\Category
     *
     * @property int $id
     * @property string $title
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
     * @property-read int|null $events_count
     * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Category query()
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
     */
    class Category extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\Event
     *
     * @property int $id
     * @property int $user_id
     * @property User $user
     * @property int $category_id
     * @property int $slots
     * @property Category $category
     * @property string $title
     * @property string $thumbnail_url
     * @property string $description
     * @property string $coordinate_lng
     * @property string $coordinate_lat
     * @property string $country
     * @property string $city
     * @property string $planing_time
     * @property string $is_happened
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
     * @method static \Illuminate\Database\Query\Builder|Event onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|Event query()
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereCategoryId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereCity($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereCoordinates($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereCountry($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereIsHappened($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event wherePlaningTime($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereThumbnailUrl($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
     * @method static \Illuminate\Database\Query\Builder|Event withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Event withoutTrashed()
     */
    class Event extends \Eloquent
    {
    }
}

namespace App\Models {
    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property string|null $email_verified_at
     * @property string $password
     * @property string|null $google_token
     * @property string|null $facebook_token
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property string $avatar_url
     * @property string|null $description
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
     * @property-read int|null $tokens_count
     * @method static \Database\Factories\UserFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarUrl($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereDescription($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebookToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     */
    class User extends \Eloquent
    {
    }
}

