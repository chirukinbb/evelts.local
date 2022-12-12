<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventListRequest;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Repositories\EventRepository;
use App\Repositories\GeoRepository;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(protected EventRepository $service)
    {
    }

    public function index(EventListRequest $request)
    {
        return EventResource::collection($this->service->select($request->all()));
    }

    public function get(int $id)
    {
        return EventResource::make($this->service->get($id));
    }

    public function create(EventRequest $request)
    {
        $address = new GeoRepository($request->address);
        $address->geocoding();

        $eventModel = Event::getModel();

        $eventModel->title = $request->title;
        $eventModel->description = $request->description;
        $eventModel->thumbnail_url = $request->thumbnail->storePublicly('events/thumbnails');
        $eventModel->address = $request->address;
        $eventModel->category_id = $request->category_id;
        $eventModel->planing_time = $request->planing_time;
        $eventModel->user_id = \Auth::id();
        $eventModel->slots = $request->slots;
        $eventModel->country_id = $address->country_id;
        $eventModel->point_id = $address->point_id;
        $eventModel->coordinate_lat = $address->lat;
        $eventModel->coordinate_lng = $address->lng;

        $eventModel->save();

        return EventResource::make($eventModel);
    }

    public function update(EventRequest $request)
    {
        $this->service->update($request->full());

        return response()->json();
    }

    public function subscribe(int $eventId)
    {
        $this->service->subscribe($eventId);

        return response()->json();
    }

    public function unsubscribe(int $eventId)
    {
        $this->service->unsubscribe($eventId);

        return response()->json();
    }

    public function addComment(int $eventId, Request $request)
    {
        $this->service->addComment($eventId, $request->all());

        return response()->json();
    }

    public function editComment(int $eventId, Request $request)
    {
        $this->service->editComment($eventId, $request->post('content'));

        return response()->json();
    }

    public function deleteComment(int $eventId)
    {
        $this->service->deleteComment($eventId);

        return response()->json();
    }
}
