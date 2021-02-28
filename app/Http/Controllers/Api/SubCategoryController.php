<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\SubCategoryRepository;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    private $repository;

    public function __construct(SubCategoryRepository $repo)
    {
        $this->repository = $repo;
    }

    public function getAllSubCategories() {
        try {
            $subCategories = $this->repository->all();

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $subCategories
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

    public function getSubCategoriesByCategoryId($category_id) {
        try {
            $subCategories = $this->repository->get($category_id);

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $subCategories
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

    public function createSubcategory($category_id, Request $request) {
        try {
            $data = [
                'category_id' => $category_id,
                'name'        => $request->get('name')
            ];
            $subCategories = $this->repository->create($data);

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $subCategories
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

    public function deleteSubcategory($sub_category_id) {
        try {
            $subCategories = $this->repository->delete($sub_category_id);

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $subCategories
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

    public function updateSubcategory($category_id, Request $request) {
        try {
            $subCategories = $this->repository->update($category_id, $request->all());

            return response()->json(
                [
                    "success"   => true,
                    "data"      => $subCategories
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
