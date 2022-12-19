<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use App\Models\Event;
use App\Models\Photo;

class EventSubEntitiesController extends Controller
{
    public function __construct()
    {
    }

    public function addPhoto(int $id, PhotoRequest $request)
    {
        if (Event::find($id)->author->id === \Auth::id()) {
            $photoModel = Photo::getModel();

            $photoModel->photo_url = $request->photo->storePublicly('public/events/photos');
            $photoModel->event_id = $id;

            $photoModel->save();
        }
    }

    public function removePhoto(int $id)
    {
        $photo = Photo::find($id);

        if ($photo->event->author->id === \Auth::id()) {
            $photo->delete();
        }
    }
}
