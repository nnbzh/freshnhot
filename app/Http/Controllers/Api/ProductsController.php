<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllProducts() {
        try {
            $products = $this->repository->all();

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $products
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

    public function createProduct(Request $request) {
        try {
            $product = $this->repository->create($request->all());

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $product
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
