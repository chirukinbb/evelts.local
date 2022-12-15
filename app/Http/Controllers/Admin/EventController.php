<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\GeoRepository;
use App\Services\TagService;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::all();

        return view('admin.events.create', compact(
            'users',
            'categories',
            'tags'
        ));
    }

    public function store(EventRequest $request)
    {
        $address = new GeoRepository($request->address);
        $address->geocoding();

        $eventModel = Event::getModel();

        $eventModel->title = $request->title;
        $eventModel->description = $request->description;
        $eventModel->thumbnail_url = $request->thumbnail->storePublicly('public/events/thumbnails');
        $eventModel->category_id = $request->category_id;
        $eventModel->planing_time = $request->planing_time;
        $eventModel->user_id = $request->user_id;
        $eventModel->slots = $request->slots;
        $eventModel->address = $request->address;
        $eventModel->country_id = $address->country_id;
        $eventModel->point_id = $address->point_id;
        $eventModel->coordinate_lat = $address->lat;
        $eventModel->coordinate_lng = $address->lng;

        $eventModel->save();

        $tagService = new TagService($eventModel);

        $tagService->action($request->tags);

        return redirect()->route('admin.events.index')->with('success', 'Event created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $event = Event::find($id);
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::all();

        return view('admin.events.edit', compact(
            'event',
            'users',
            'categories',
            'tags'
        ));
    }

    public function update(EventRequest $request, $id)
    {
        $address = new GeoRepository($request->address);
        $address->geocoding();

        $eventModel = Event::find($id);

        $eventModel->title = $request->title;
        $eventModel->description = $request->description;
        $eventModel->category_id = $request->category_id;
        $eventModel->planing_time = $request->planing_time;
        $eventModel->user_id = $request->user_id;
        $eventModel->slots = $request->slots;
        $eventModel->address = $request->address;
        $eventModel->country_id = $address->country_id;
        $eventModel->point_id = $address->point_id;
        $eventModel->coordinate_lat = $address->lat;
        $eventModel->coordinate_lng = $address->lng;

        if ($request->thumbnail) {
            $eventModel->thumbnail_url = $request->thumbnail->storePublicly('public/events/thumbnails');
        }

        $eventModel->save();

        $tagService = new TagService($eventModel);

        $tagService->action($request->tags);

        return redirect()->route('admin.events.index')->with('success', 'Event updated!');
    }

    public function destroy($id)
    {
        Event::find($id)->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted!');
    }
}
