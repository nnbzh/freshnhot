<?php


namespace App\Repositories;


use App\Models\Event;
use App\Models\Paragraph;

class EventRepository {

    public function getEvents() {
        return Event::query()->where('is_event', '=', true)->get()->toArray();
    }

    public function getSales() {
        return Event::query()->where('is_event', '=', false)->get()->toArray();
    }

    public function createEventOrSale($data) {
        $event = Event::query()->updateOrCreate($data);

        return $event;
    }

    public function getEvent($id) {
        $event = Event::with('paragraphs')->findOrFail('id', $id)->toArray();

        return $event;
    }

    public function createParagraph($data) {
        return Paragraph::query()->updateOrCreate($data);
    }

    public function updateParagraph($id, $data) {
        return Paragraph::query()->where($id, 'id')->update($data);
    }



}
