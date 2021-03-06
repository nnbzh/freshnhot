<?php


namespace App\Repositories;


use App\Models\Event;
use App\Models\Paragraph;

class EventRepository
{

    public function getEvents($type)
    {
        if ($type == 'all') {
            return Event::all()->toArray();
        }

        return Event::query()->where('type', 'like', "%$type%");
    }

    public function createEvent($data)
    {
        return Event::query()->updateOrCreate($data);
    }

    public function getEvent($id)
    {
        return Event::with('paragraphs')->findOrFail('id', $id)->toArray();
    }

    public function deleteEvent($id)
    {
        $event = Event::query()->findOrFail($id);
        try {
            $event->delete();
        } catch (\Exception $e) {
        }

        return $event;
    }

    public function updateEvent($id, $data)
    {
        return Event::query()->where($id, 'id')->update($data);
    }

    public function createParagraph($data)
    {
        return Paragraph::query()->updateOrCreate($data);
    }

    public function updateParagraph($id, $data)
    {
        return Paragraph::query()->where($id, 'id')->update($data);
    }

    public function deleteParagraph($id)
    {
        $paragraph = Paragraph::query()->findOrFail($id);
        $paragraph->delete();

        return $paragraph;
    }


}
