<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use yidas\googleMaps\Client;
use function dd;
use function env;

class EventRepository
{
    protected Builder $eventQueryBuilder;

    public function __construct()
    {
        $this->eventQueryBuilder = Event::query();
    }

    public function getList(array $attrs)
    {
        foreach ($attrs as $key => $value) {
            call_user_func([$this, $key], $value);
        }

        return $this->eventQueryBuilder->get();
    }

    protected function search(string $query)
    {
        $this->eventQueryBuilder->where('title', 'like', '%'.$query.'%')
            ->orWhere('title', 'like', '%'.$query.'%');
    }

    protected function countries(array $countries)
    {
        $this->eventQueryBuilder->whereIn('country_id', $countries);
    }

    protected function points(array $cities)
    {
        $this->eventQueryBuilder->whereIn('point_id', $cities);
    }

    protected function categories(array $categories)
    {
        $this->eventQueryBuilder->whereIn('category_id', $categories);
    }

    protected function authors(array $authors)
    {
        $this->eventQueryBuilder->whereIn('user_id', $authors);
    }

    protected function dates(array $dates)
    {
        $this->eventQueryBuilder->whereBetween('planing_time', $dates);
    }

    public function create(array $attrs)
    {
//        $event = Event::getModel();
//
//        $event->title = $attrs['title'];
//        $event->description = $attrs['description'];
//        $event->thumbnail_url = $attrs['thumbnail']->storePublic('events');
//        $event->user_id = \Auth::id();
//        $event->category_id = Category::whereTitle($attrs['description'])->first()->id;
//        $event->coordinate_lat = $attrs['coordinate_lat'];
//        $event->coordinate_lng = $attrs['coordinate_lng'];
//        $event->planing_time = $attrs['planing_time'];

        $http = \Http::get(
            'https://api.tomtom.com/search/2/geocode/'.$attrs['address'].'.json',
            ['params' => ['key' => env('TOM_TOM_GEOCODING_API_KEY')]]
        );

        dd($http->body());
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
    }

    public function get(int $id)
    {
        return Event::whereId($id)->first();
    }

    public function subscribe(int $eventId)
    {
        Event::whereId($eventId)->subscribers()->create(['user_id' => \Auth::id()]);
    }

    public function unsubscribe(int $eventId)
    {
        Event::whereId($eventId)->subscribers()->where('user_id', \Auth::id())->delete();
    }

    public function addComment(int $eventId, array $attrs)
    {
        Event::whereId($eventId)->comments->create([
            'user_id' => \Auth::id(),
            'content' => $attrs['content'],
            'parent_comment_id' => $attrs['parent_comment_id'] ?? 0
        ]);
    }

    public function editComment(int $commentId, string $content)
    {
        $comment = Event::whereId($commentId)->first();

        if ($comment->user_id === \Auth::id() && Comment::whereParentCommentId($commentId)->doesntExist()) {
            $comment->update(['content' => $content]);
        }
    }

    public function deleteComment(int $commentId)
    {
        $comment = Event::whereId($commentId)->first();

        if ($comment->user_id === \Auth::id() && Comment::whereParentCommentId($commentId)->doesntExist()) {
            $comment->delete();
        }
    }
}
