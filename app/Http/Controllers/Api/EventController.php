<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    private $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addEvent(Request $request) {
        try {
            $validation = Validator::make($request->all(),
                [
                    'title'     => 'required|exists:events,id',
                    'content'   => 'required',
                    'type'      => 'required'
                ]
            );

            if ($validation->fails()) {
                return [
                    "success"   => false,
                    "errors"    => $validation->errors()
                ];
            }
            $event = $this->repository->createEvent($request->all());

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $event
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ]
            );
        }
    }

    public function updateEvent($id, Request $request) {
        try {
            $event = $this->repository->updateEvent($id, $request->all());

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $event
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ]
            );
        }
    }

    public function getAllEvents(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'type' => 'required'
            ]);

            if ($validation->fails()) {
                return [
                    "success" => false,
                    "errors" => $validation->errors()
                ];
            }

            $events = $this->repository->getEvents($request->get('type'));

            return response()->json(
                [
                    "success" => true,
                    "data" => $events
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success" => false,
                    "message" => $exception->getMessage()
                ]
            );
        }
    }

    public function getEvent($id) {
        try {
            $events = $this->repository->getEvent($id);

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $events
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ]
            );
        }
    }

    public function deleteEvent($id) {
        try {
            return response()->json(
                [
                    "success"   => true,
                    "data"      => $this->repository->deleteEvent($id)
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ]
            );
        }
    }

    public function addParagraph(Request $request) {
        try {
            $validation = Validator::make($request->all(),
                [
                    'event_id'  => 'required|exists:events,id',
                    'title'     => 'required',
                    'content'   => 'required',
                ]
            );

            if ($validation->fails()) {
                return [
                    "success"   => false,
                    "errors"    => $validation->errors()
                ];
            }
            $event = $this->repository->createParagraph($request->all());

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $event
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ]
            );
        }
    }

    public function updateParagraph($id, Request $request) {
        try {
            $event = $this->repository->updateParagraph($id, $request->all());

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $event
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ]
            );
        }
    }

    public function deleteParagraph($id) {
        try {
            $event = $this->repository->deleteParagraph($id);

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $event
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "message"   => $exception->getMessage()
                ]
            );
        }
    }

}
