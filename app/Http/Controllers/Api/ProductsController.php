<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

//    public function createProduct(Request $request) {
//        try {
//            $product = $this->repository->create($request->all());
//
//            return response()->json(
//                [
//                    "success"   => true,
//                    "data"      => $product
//                ]
//            );
//        } catch (\Exception $exception) {
//            return response()->json(
//                [
//                    "success"   => false,
//                    "message"   => $exception->getMessage()
//                ]
//            );
//        }
//    }

    public function updateProduct($id, Request $request) {
        try {
            $validation = Validator::make($request->all(),
                [
                    'category_id'       => 'exists:categories,id',
                    'sub_category_id'   => 'exists:sub_categories,id'
                ]
            );

            if ($validation->fails()) {
                return [
                    "success"   => false,
                    "errors"    => $validation->errors()
                ];
            }
            $product = $this->repository->update($id, $request->all());

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

    public function getProductById($id) {
        try {
            $product = $this->repository->get($id);

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

    public function updateStock(Request $request) {
        try {
            $product = $this->repository->updateStock($request->all());

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
