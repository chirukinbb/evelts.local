<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Country;
use App\Models\Event;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function categories()
    {
        return CategoryResource::collection(Category::whereHas('events')->get());
    }

    public function tags()
    {
        return TagResource::collection(Tag::whereHas('events')->get());
    }

    public function countries()
    {
        return CountryResource::collection(Country::whereHas('events')->get());
    }

    public function authors()
    {
        return UserResource::collection(User::whereHas('events')->get());
    }
}
