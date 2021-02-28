<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Repositories\SubCategoryRepository;

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

    public function createSubcategory($category_id) {
        try {
            $subCategories = $this->repository->create($category_id);

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
