<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
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
        $response = \Http::withHeaders(['Referer' => route('home')])->get(
            sprintf('https://api.tomtom.com/search/2/geocode/%s.json', 'прилуки ветеранская 28'/*$request->address*/),
            ['key' => env('TOM_TOM_GEOCODING_API_KEY')]
        );
dd(json_decode($response->body()));
     //   list($address) = json_decode($response->body());

        $eventModel = Event::getModel();


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
