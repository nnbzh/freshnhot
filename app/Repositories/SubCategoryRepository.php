<?php


namespace App\Repositories;


use App\Models\SubCategory;

class SubCategoryRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return SubCategory::with('category')->get()->toArray();
    }

    public function get($id)
    {
        return SubCategory::query()->where('category_id', $id)->get()->toArray();
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
