<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return Category::with(['products', 'subs'])->get()->toArray();
    }

    public function get($id)
    {
        return Category::query()->where('id', $id)->with('products')->get()->toArray();
    }

    public function create($data)
    {
        $category = Category::query()->updateOrCreate($data);

        return $category;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($id, $data)
    {
        $category = Category::query()->findOrFail($id);
        $category->update($data);

        return $category;
    }
}
