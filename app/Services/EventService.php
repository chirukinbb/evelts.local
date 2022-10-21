<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use yidas\googleMaps\Client;

class EventService
{
    public function select(array $attrs)
    {
        $events = Event::query();

        foreach ($attrs['filter'] as $key => $value) {
            $events = call_user_func([$this, $key], $events, $value);
        }

        return $events->paginate(env('PAGINATION_COUNT'));
    }

    protected function country(Builder $builder, array $countries)
    {
        return $builder->where('country', 'in', $countries);
    }

    protected function city(Builder $builder, array $cities)
    {
        return $builder->where('city', 'in', $cities);
    }

    protected function category(Builder $builder, array $categories)
    {
        return $builder->whereRelation('category', 'title', 'in', $categories);
    }

    protected function author(Builder $builder, array $authors)
    {
        return $builder->whereRelation('user', 'name', 'in', $authors);
    }

    protected function date(Builder $builder, array $dates)
    {
        return $builder->whereBetween('planing_time', $dates);
    }

    public function create(array $attrs)
    {
        $event = Event::getModel();

        $event->title = $attrs['title'];
        $event->description = $attrs['description'];
        $event->thumbnail_url = $attrs['thumbnail']->storePublic('events');
        $event->user_id = \Auth::id();
        $event->category_id = Category::whereTitle($attrs['description'])->first()->id;
        $event->coordinate_lat = $attrs['coordinate_lat'];
        $event->coordinate_lng = $attrs['coordinate_lng'];
        $event->planing_time = $attrs['planing_time'];

        $client = new Client(['key' => env('GOOGLE_CLIENT_ID')]);
        $place = $client->reverseGeocode([
            $attrs['coordinate_lat'], $attrs['coordinate_lng']
        ]);
        dd($place);
    }

    public function update(array $attrs)
    {
        $event = Event::whereId($attrs['id'])->first();

        $event->title = $attrs['title'];
        $event->description = $attrs['description'];
        $event->thumbnail_url = $attrs['thumbnail']->storePublic('events');
        $event->category_id = Category::whereTitle($attrs['description'])->first()->id;
        $event->coordinate_lat = $attrs['coordinate_lat'];
        $event->coordinate_lng = $attrs['coordinate_lng'];
        $event->planing_time = $attrs['planing_time'];

        $client = new Client(['key' => env('GOOGLE_CLIENT_ID')]);
        $place = $client->reverseGeocode([
            $attrs['coordinate_lat'], $attrs['coordinate_lng']
        ]);
        dd($place);
    }

    public function get(int $id)
    {
        return Event::whereId($id)->first();
    }
}
