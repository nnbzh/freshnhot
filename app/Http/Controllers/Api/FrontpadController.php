<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\Services\FrontpadApiService;
use Illuminate\Http\Request;

class FrontpadController extends Controller
{
    private $service;

    public function __construct(FrontpadApiService $service)
    {
        $this->service = $service;
    }

    public function synchronizeFrontpad() {
        try {
            return response()->json(
                [
                    "success"   => true,
                    "data"      => $this->service->syncWithProducts()
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "error"     => $exception->getMessage()
                ]
            );
        }
    }

    public function createNewOrder(Request $request) {
        try {
            return response()->json(
                [
                    "success"   => true,
                    "data"      => $this->service->newOrder($request->all())
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "success"   => false,
                    "error"     => $exception->getMessage()
                ]
            );
        }
    }
}
