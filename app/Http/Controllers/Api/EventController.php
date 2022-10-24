<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventListRequest;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use Illuminate\Http\Request;

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

        return response()->json();
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
