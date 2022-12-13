<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use App\Repositories\GeoRepository;
use App\Services\TagService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return view('admin.events.create', compact(
            'users',
            'categories'
        ));
    }

    public function store(EventRequest $request)
    {
        $address = new GeoRepository($request->address);
        $address->geocoding();

        $eventModel = Event::getModel();

        $eventModel->title = $request->title;
        $eventModel->description = $request->description;
        $eventModel->thumbnail_url = $request->thumbnail->storePublicly('events/thumbnails');
        $eventModel->category_id = $request->category_id;
        $eventModel->planing_time = $request->planing_time;
        $eventModel->user_id = $request->user_id;
        $eventModel->slots = $request->slots;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $events = Event::paginate(15);
        $categories = Category::all();
        $users = User::all();
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
