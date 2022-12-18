<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function __construct(protected EventRepository $repository)
    {
    }

    public function dates()
    {
        return response()->json([
            'start_date' => $this->repository->earlyEventDate(),
            'end_date' => $this->repository->latestEventDate()
        ]);
    }

    public function categories()
    {
    }

    public function tags()
    {
    }

    public function countries()
    {
    }

    public function authors()
    {
    }
}
