<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\Services\FrontpadApiService;

class FrontpadController extends Controller
{
    private $service;

    public function __construct(FrontpadApiService $service)
    {
        $this->service = $service;
    }

    public function getProducts() {
        try {
            return response()->json(
                [
                    "data" => $this->service->getProducts()
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    "error" => $exception->getMessage()
                ]
            );
        }
    }
}
