<?php


namespace App\Http\Controllers\Api;


use App\Repositories\PromoCodeRepository;

class PromoCodeController
{
    private $repository;

    public function __construct(PromoCodeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function generatePromoCode() {
        try {

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $this->repository->generatePromoCode()
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

    public function getPromoCodes() {
        try {

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $this->repository->getAllPromoCodes()
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
