<?php


namespace App\Http\Controllers\Api;


use App\Repositories\PromoCodeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function createPromoCode(Request $request) {
        try {
            $validation = Validator::make($request->all(), [
                "code"  => 'required|unique:promo_codes,code',
                "value" => 'gt:0|lt:100'
            ]);

            if ($validation->fails()) {
                return response()->json([
                   "success"    => false,
                   "error"      => $validation->errors()
                ]);
            }

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $this->repository->createPromoCode($request->all())
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

    public function getPromoCode($code) {
        try {

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $this->repository->getPromoCode($code)
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
    public function deletePromoCode($id) {
        try {

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $this->repository->deletePromoCode($id)
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
