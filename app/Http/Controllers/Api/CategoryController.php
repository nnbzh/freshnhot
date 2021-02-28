<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createCategory(Request $request) {
        try {
            $validation = Validator::make($request->all(),
                [
                    'name'              => 'required',
                    'img_src'           => 'required'
                ]
            );

            if ($validation->fails()) {
                return [
                    "success"   => false,
                    "errors"    => $validation->errors()
                ];
            }
            $category = $this->repository->create($request->all());

            return response()->json(
                [
                    'success' => true,
                    'data' => $category
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage()
                ]
            );
        }
    }

    public function getAllCategories(Request $request) {
        try {

            return response()->json(
                [
                    'success' => true,
                    'data' => $this->repository->all()
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage()
                ]
            );
        }
    }

    public function updateCategory($id, Request $request) {
        try {

            return response()->json(
                [
                    'success'   => true,
                    'data'      => $this->repository->update($id, $request->all)
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage()
                ]
            );
        }
    }

    public function getCategoryById($id) {
        try {

            return response()->json(
                [
                    'success'   => false,
                    'data'      => $this->repository->get($id)
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage()
                ]
            );
        }
    }
}
