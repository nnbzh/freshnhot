<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository implements BaseRepositoryInterface
{

    public function all()
    {
        return Category::all()->toArray();
    }

    public function get($id)
    {
        return Category::query()->where('id', $id)->with('products')->get()->toArray();
    }

    public function create($data)
    {
        $category = new Category();
        $category->name = $data['name'];
        $category->img_src = $data['img_src'];

        $category->saveOrFail();

        return $category;
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
