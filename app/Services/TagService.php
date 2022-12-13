<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Tag;

class TagService
{
    public function __construct(protected Event $event)
    {
    }

    public function action(array $tagNames)
    {
        foreach ($tagNames as $name) {
            $tag = $this->getTagModel($name);
            $this->save($tag);
        }
    }

    protected function getTagModel(string $name)
    {
        return Tag::firstOrCreate(['name' => mb_strtolower($name)]);
    }

    protected function save(Tag $tag)
    {
        $this->event->tags()->save($tag);
    }
}
