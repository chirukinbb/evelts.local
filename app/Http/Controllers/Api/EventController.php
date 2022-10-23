<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventListRequest;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Services\EventService;

class EventController extends Controller
{
    public function __construct(protected EventService $service)
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
        $this->service->create($request->full());

        return response()->json(1);
    }

    public function update(EventRequest $request)
    {
        $this->service->update($request->full());

        return response()->json(1);
    }

    public function subscribe(int $eventId)
    {
    }

    public function unsubscribe(int $eventId)
    {
    }
}
