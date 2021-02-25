<?php


namespace App\Repositories;


use App\Models\SubCategory;

class SubCategoryRepository implements BaseRepositoryInterface
{

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function create($data)
    {
        $sub = SubCategory::query()->updateOrCreate($data);

        return $sub;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }
}
